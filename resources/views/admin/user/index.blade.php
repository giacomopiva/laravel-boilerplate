@extends('layouts.admin.app')

@section('style')
<!-- Page Style -->
<style>
:root{
    --max-btn-count: 3;
    --max-btn-width: 90px;
    --btn-margin-right: 10px;
}

.table.dataTable thead tr th:last-child {
    width: calc(var(--max-btn-count) * var(--max-btn-width) + var(--max-btn-count) * var(--btn-margin-right)) !important;
    min-width: calc(var(--max-btn-count) * var(--btn-margin-right)) !important;
    max-width: 30%;
}
</style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>GESTIONE UTENTI
                <small>Dashboard gestione utenti</small>
            </h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-collapsable">
                    <div class="header">
                        <h2><i class="material-icons">people</i>Elenco degli utenti</h2>
                        <ul class="header-dropdown m-r--5">
                            <li>
                                <a href="javascript:void(0);" class="collapsable-handler">
                                    <i class="material-icons">vertical_align_center</i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ url('admin/users/create') }}" role="button" onclick=""
                                            name="crea_nuovo" id="nuovo_utente" class=" waves-effect waves-block"
                                            value="Nuovo utente"><i class="material-icons">add</i> Nuovo utente</a>
                                    </li>
                                    <li><a href="{{ url('admin/users/export/excel') }}" role="button" onclick=""
                                        name="esporta" id="esporta" class=" waves-effect waves-block"
                                        value="Esporta file Excel"><i class="material-icons">file_download</i> Esporta su Excel</a>
                                    </li>
                                    <li><a href="{{ url('admin/users/export/gsheet') }}" role="button" onclick=""
                                        name="esporta" id="esporta" class=" waves-effect waves-block"
                                        value="Esporta Google Sheet"><i class="material-icons">cloud_upload</i> Esporta su Google</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body body-collapsable open">
                        @if ($errors->any())
                            <div id="errors-container" class="alert alert-danger alert-dismissible">
                                <span>Si è verificato un errore: {{ $errors->first() }}</span>
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div id="msg-container" class="alert alert-success alert-dismissible">
                                <span>{!! \Session::get('success') !!}</span>
                            </div>
                        @endif
                                   
                        <div class="table-responsive">
                            <table id="utenti_table"
                                class="table table-bordered table-striped table-hover dataTable" role="grid"
                                aria-describedby="DataTables_Table_1_info" style="width: 100%;  height:100%;"
                                cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Ruolo</th>
                                        <th>Data di creazione</th>
                                        <th>Ultima modifica</th>
                                        <th>Azioni</th>
                                    </tr>
                                </thead>
                                <tbody><!-- Gestito dalla DataTable AJAX --></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Page Script -->
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#utenti_table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
			//stateSave: true, // Permette di salvare lo stato della DT 
            ajax: {
                url: "{!! url('admin/users/list') !!}",
                type: "post",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }
            },
            "columns": [
                { "data": 'id' },
                { "data": 'name' },
                { "data": 'email' },
                {
                    "data": 'rolename',
                    "searchable": false
                },                    
                {
                    "data": 'created_at',
                    "searchable": false,
                    render: function(data, type, row) {
                        return data ? moment(data).format('DD/MM/YYYY') : '';
                    }
                },                    
                {
                    "data": 'updated_at',
                    "searchable": false,
                    render: function(data, type, row) {
                        return data ? moment(data).format('DD/MM/YY HH:MM') : '';
                    }
                },                    
                {
                    "data": 'actions',
                    "searchable": false,
                    "orderable": false
                },
            ],
            "columnDefs": [
                { "width": '30px', "targets": 0 }, // Esempio di imposizione della dimensione della colonna.
            ],
            "lengthMenu": [25, 50, 100],
            "pageLength": 25,
            "order": [
                [0, "asc"]
            ],
            "language": {
                "url": "{!! url('vendor/datatables/Italian.json') !!}"
            },
            "drawCallback": function(settings, json) {
                $(bind_elimina);
            },
            "initComplete": function(settings, json) {
                // Ultima ad essere chiamata
            },
        });
    });

    /** 
     * Bind del bottone Elimina
     */
    var bind_elimina = function() {
        $('.btn-elimina').bind('click', function(event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            swal({
                title: "Sei sicuro?",
                text: "Procedere alla cancellazione dell'utente?. L'azione è irreversibile e l'utente sarà definitivamente eliminato dal sistema",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#fb483a",
                confirmButtonText: "Si, procedi",
                cancelButtonText: "No, annulla",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{!! url('admin/users') !!}/" + id,
                        type: "delete",
                        dataType: "json",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(data) {
                            table.ajax.reload();
                            swal("Utente eliminato", data.message, "success");
                        },
                        error: function(response, stato) {
                            swal.close();
                            showNotification('alert-danger', response.responseJSON.message, 'top', 'right', null, null);
                        }
                    });
                } else {
                    swal("Operazione annullata", "L'operazione è stata annullata", "info");
                }
            });
        });
    }
</script>
@endsection
