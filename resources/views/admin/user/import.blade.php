@extends('layouts.app')

@section('content')

{{-- ── Page header ────────────────────────────────── --}}
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <a href="{{ route('admin.user.index') }}" class="btn btn-ghost-secondary btn-sm">
                    <i class="ti ti-arrow-left me-1"></i>Utenti
                </a>
            </div>
            <div class="col">
                <div class="page-pretitle">Sistema</div>
                <h2 class="page-title">Importa utenti da Excel</h2>
            </div>
        </div>
    </div>
</div>

{{-- ── Page body ───────────────────────────────────── --}}
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            {{-- Upload area --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-file-upload me-2 text-secondary"></i>Caricamento file
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.import') }}"
                            id="fileInsert"
                            class="dropzone"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="dz-message">
                                <div class="mb-3">
                                    <i class="ti ti-cloud-upload text-secondary" style="font-size:3rem;"></i>
                                </div>
                                <h3>Trascina qui il file o clicca per selezionarlo</h3>
                                <p class="text-secondary mb-0">
                                    Carica il file <code>Utenti.xlsx</code> per aggiornare l'elenco degli utenti
                                </p>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" accept=".xlsx" multiple />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Preview table --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-users me-2 text-secondary"></i>Utenti presenti nel sistema
                        </h3>
                    </div>
                    <div class="card-body p-0">

                        @if ($errors->any())
                            <div class="alert alert-danger m-3 alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <i class="ti ti-alert-triangle me-2 flex-shrink-0 mt-1"></i>
                                    <div>{{ $errors->first() }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success m-3 alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <i class="ti ti-circle-check me-2 flex-shrink-0 mt-1"></i>
                                    <div>{!! \Session::get('success') !!}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="users_table"
                                class="table table-vcenter card-table"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:50px">#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Ruolo</th>
                                        <th>Data creazione</th>
                                        <th>Ultima modifica</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    var table;

    $(document).ready(function () {
        table = $('#users_table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{!! url('admin/user/list') !!}",
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') }
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'rolename' },
                {
                    data: 'created_at',
                    searchable: false,
                    render: function (data) { return data ? moment(data).format('DD/MM/YYYY') : '—'; }
                },
                {
                    data: 'updated_at',
                    searchable: false,
                    render: function (data) { return data ? moment(data).format('DD/MM/YY HH:mm') : '—'; }
                }
            ],
            columnDefs: [{ width: '50px', targets: 0 }],
            lengthMenu: [25, 50, 100],
            pageLength: 25,
            order: [[0, 'asc']],
            language: { url: "{!! url('vendor/datatables/Italian.json') !!}" }
        });
    });

    Dropzone.options.fileInsert = {
        sending: function () {},
        success: function (file, response) {
            Swal.fire({ icon: 'success', title: 'File caricato!', text: 'Utenti importati con successo.', timer: 2500, showConfirmButton: false });
            table.ajax.reload();
        },
        error: function (file, response) {
            let msg = 'Si è verificato un errore durante il caricamento.';
            if (response && response.errors) {
                const firstKey = Object.keys(response.errors)[0];
                msg = response.errors[firstKey];
            }
            Swal.fire('Errore', msg, 'error');
        }
    };
</script>
@endsection
