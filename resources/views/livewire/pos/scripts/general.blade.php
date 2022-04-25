<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".tblscroll").niceScroll();

    $(".nested").select2();

    function addCart()
    {
        var codeP = $("#codeP").value;
        window.livewire.emit('scan-code', codeP)
    }

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
