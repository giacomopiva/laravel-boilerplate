@extends('layouts.app')

@section('content')

{{-- ───────────────────────────────────────────────
     Page header  ·  container-xl è DENTRO l'header
     ─────────────────────────────────────────────── --}}
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Sistema</div>
                <h2 class="page-title">Utenti</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-group">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>Nuovo utente
                    </a>
                    <button type="button"
                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Altro</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.user.exportToExcel') }}">
                                <i class="ti ti-download me-2"></i>Esporta su Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.user.showImport') }}">
                                <i class="ti ti-upload me-2"></i>Importa da Excel
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ───────────────────────────────────────────────
     Page body  ·  container-xl > row row-cards
     ─────────────────────────────────────────────── --}}
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-list me-2 text-secondary"></i>Elenco degli utenti
                        </h3>
                    </div>
                    {{-- p-0: rimuove il padding per avere la tabella flush con i bordi della card --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="users_table"
                                class="table table-vcenter card-table"
                                style="width:100%"
                                data-ajax-url="{{ route('admin.user.list') }}">
                                <thead>
                                    <tr>
                                        <th style="width:50px">#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Ruolo</th>
                                        <th>Stato</th>
                                        <th>Creato il</th>
                                        <th>Aggiornato il</th>
                                        <th style="width:180px">Azioni</th>
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
            deferRender: true,
            ajax: {
                url: $('#users_table').data('ajax-url'),
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') }
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'rolename', searchable: false },
                {
                    data: 'status',
                    searchable: true,
                    render: function (data) {
                        return data
                            ? '<span class="badge bg-success-lt text-success">Abilitato</span>'
                            : '<span class="badge bg-danger-lt text-danger">Disabilitato</span>';
                    }
                },
                {
                    data: 'created_at',
                    searchable: false,
                    render: function (data) { return data ? moment(data).format('DD/MM/YY HH:mm') : '—'; }
                },
                {
                    data: 'updated_at',
                    searchable: false,
                    render: function (data) { return data ? moment(data).format('DD/MM/YY HH:mm') : '—'; }
                },
                { data: 'actions', searchable: false, orderable: false }
            ],
            lengthMenu: [25, 50, 100],
            pageLength: 25,
            order: [[0, 'asc']],
            language: { url: "{{ asset('vendor/datatables/Italian.json') }}" },
            drawCallback: function () { bindDelete(); }
        });

        function bindDelete() {
            $('.btn-delete').off('click').on('click', function (e) {
                e.preventDefault();
                var id  = $(this).data('id');
                var url = '{{ route('admin.user.destroy', ':id') }}'.replace(':id', id);

                Swal.fire({
                    title: 'Elimina utente',
                    text: "Sei sicuro? L'azione è irreversibile.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d63939',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sì, elimina',
                    cancelButtonText: 'Annulla'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            dataType: 'json',
                            data: { _token: $('meta[name="csrf-token"]').attr('content') },
                            success: function (response) {
                                table.ajax.reload();
                                Swal.fire({ icon: 'success', title: 'Eliminato', text: response.message, timer: 2000, showConfirmButton: false });
                            },
                            error: function (response) {
                                Swal.fire('Errore', response.responseJSON?.errors ?? 'Errore sconosciuto', 'error');
                            }
                        });
                    }
                });
            });
        }
    });
</script>
@endsection
