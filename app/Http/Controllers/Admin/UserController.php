<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Models\User;
use App\Services\GoogleCalendarEvent;
use App\Services\GoogleSheet;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Validator;
use Yajra\DataTables\DataTables;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Ritorna il contenuto della DataTable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON
     */
    public function list(Request $request)
    {
        $users = User::all();

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                $buttons = '<span class="mr-1"><a href="users/'.$user->id.'/edit" data-id="'.$user->id.'" class="btn waves-effect btn-primary"><i class="material-icons">edit</i><span>Modifica</span></a></span>';
                $buttons .= '<span class="mr-1"><a href="users/'.$user->id.'/print" data-id="'.$user->id.'" class="btn waves-effect btn-default"><i class="material-icons">print</i><span>Stampa</span></a></span>';

                if (Auth::user()->id != $user->id) {
                    $buttons .= '<span class="mr-1"><button data-id="'.$user->id.'" class="btn waves-effect btn-danger btn-elimina"><i class="material-icons">delete</i><span>Elimina</span></button></span>';
                }

                return $buttons;
            })
            ->editColumn('rolename', function ($user) {
                return $user->roleName();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::$roles;

        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique_encrypted:users,email',
                'password' => 'required|string|min:6',
            ], [
                'email.unique_encrypted' => "L'email esiste già",
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.users.create')->withErrors($validator)->withInput();
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            $user->assignRole($input['role']);

            return view('admin.user.index');
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = User::$roles;

        if ($user) {
            return view('admin.user.edit', compact('user', 'roles'));
        }

        return redirect()->route('admin.users.index')->withErrors("L' utente non esiste");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            if (! $user) {
                return redirect()->route('admin.users.index')->withErrors("L' utente non esiste");
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique_encrypted:users,email,'.$user->id,
                'password' => 'nullable|sometimes|string|min:6',
            ], [
                'email.unique_encrypted' => "L'email esiste già",
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.users.edit', $id)->withErrors($validator)->withInput();
            }

            $input = $request->all();

            // Verifico se la password è da aggiornare
            if ($input['password'] && strlen($input['password']) > 0) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }

            $user->update($input);
            $user->syncRoles($input['role']);

            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            if (! $user) {
                return self::makeJsonResponseBadRequest('Utente non trovato');
            }

            $user->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        return self::makeJsonResponse([], 200, 'Utente eliminato');
    }

    /**
     * Esporta la risorsa specificata su file Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function export_excel()
    {
        return Excel::download(new UsersExport, 'Utenti.xlsx');
    }

    /**
     * Esporta la risorsa specificata su Google Sheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function export_gsheet()
    {
        $users = User::all();
        $data = [['Nome', 'Ruolo', 'Data di creazione']];

        foreach ($users as $user) {
            $data[] = [
                $user->name,
                $user->roleName(),
                $user->created_at->format('Y-m-d'),
            ];
        }

        try {
            $googleSheet = new GoogleSheet();
            $googleSheet->saveDataToSheet($data, true); // true -> overwrite

            $googleCalendarEvent = new GoogleCalendarEvent();
            $googleCalendarEvent->saveEvent('Esportazione completata', 'Esportazione completata con successo', Carbon::now(), 30);
        } catch (Exception $e) {
            Log::info($e->getMessage());

            return redirect()->route('admin.users.index')->withErrors('L\'export non è andato a buon fine');
        }

        return redirect()->route('admin.users.index')->with('success', 'Export riuscito.');
    }

    /**
     * Stampa una scheda informativa sull'utente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print(User $user)
    {
        /**
         * !!! POTREBBE ESSERE UTILE: https://codepen.io/rafaelcastrocouto/pen/LFAes
         */
        try {
            if (! $user) {
                return redirect()->route('admin.users.index')->withErrors("L'utente non esiste");
            }

            $pdf = PDF::loadView('admin.user.pdf.show', compact('user'));

            return $pdf->download('User.pdf');
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
