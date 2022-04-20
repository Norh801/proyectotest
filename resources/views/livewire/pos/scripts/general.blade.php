<script>
    $(".tblscroll").niceScroll();


    function Confirm(id, eventName, text)
    {
        swal({
            type: 'warning',
            title: 'Confirmar',
            text: text,
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#e7515a',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Aceptar',
        }).then(function(result){
            if(result.value){
                window.livewire.emit(eventName, id)
                swal.close()
            }
        })
    }
</script>
