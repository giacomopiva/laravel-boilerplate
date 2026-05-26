@props(['url', 'resource'])

<button type="button"
    class="btn btn-danger ms-2"
    onclick="eliminaRisorsa({{ $resource->id }}, event)">
    <i class="ti ti-trash me-1"></i>Elimina
</button>

<script type="text/javascript">
    function eliminaRisorsa(id, event) {
        event.preventDefault();
        Swal.fire({
            title: 'Sei sicuro?',
            text: "L'azione è irreversibile. L'elemento sarà definitivamente eliminato.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d63939',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sì, elimina',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{!! url($url) !!}/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        window.location.href = '{!! url($url) !!}';
                    },
                    error: function(response) {
                        Swal.fire('Errore', "L'operazione non è andata a buon fine.", 'error');
                    }
                });
            }
        });
    }
</script>
