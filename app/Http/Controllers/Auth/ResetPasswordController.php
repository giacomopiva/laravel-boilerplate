<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserResetRequest;
use App\Models\User;
use DB;
use ESolution\DBEncryption\Encrypter;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Mostra il form di reset se il token esiste ed è ancora valido.
     *
     * Il nome del metodo deve essere "showResetForm": è quello richiamato
     * dalla route "password.reset" registrata da Auth::routes() (laravel/ui).
     */
    public function showResetForm(Request $request, $token = null)
    {
        $tokenRecord = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (! $tokenRecord || $this->tokenIsExpired($tokenRecord->created_at)) {
            return redirect()->route('password.request')
                ->with('fail', 'Il link per il reset della password non è valido o è scaduto. Richiedine uno nuovo.');
        }

        return view('auth.passwords.reset-password', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @param  UserResetRequest  $request  The validated user store request.
     * @return RedirectResponse A redirect response based on the user's role.
     */
    public function reset(UserResetRequest $request): RedirectResponse
    {
        $validator = $request->validator;

        if (isset($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $request->validated();

        $dbToken = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (! $dbToken || $this->tokenIsExpired($dbToken->created_at)) {
            return redirect()->route('password.request')
                ->with('fail', 'Il link per il reset della password non è valido o è scaduto. Richiedine uno nuovo.');
        }

        $user = User::where('email', Encrypter::encrypt($dbToken->email))->first();

        if (! $user) {
            return redirect()->route('password.request')
                ->with('fail', 'Il link per il reset della password non è valido o è scaduto. Richiedine uno nuovo.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where(['email' => $dbToken->email])->delete();

        return Redirect::route(route: 'login')->with('message', 'La tua password è stata modificata correttamente!');
    }

    /**
     * Un token è valido per il numero di minuti configurato in auth.passwords.users.expire
     * (60 minuti di default), come per il broker di reset password nativo di Laravel.
     */
    private function tokenIsExpired(string $createdAt): bool
    {
        $expireMinutes = config('auth.passwords.users.expire', 60);

        // Carbon::diffInMinutes() ritorna un valore con segno (non assoluto) a partire
        // da Carbon 3: usare addMinutes()->isPast() evita ambiguità sul verso del confronto.
        return \Illuminate\Support\Carbon::parse($createdAt)->addMinutes($expireMinutes)->isPast();
    }
}
