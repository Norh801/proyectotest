
<script src="{{asset('js/keypress-2.1.5.min.js')}}"></script>
<script>
    var listener =  new window.keypress.Listener();

    listener.simple_combo("f9", function(){
        livewire.emit('saveSale')
    })

    listener.simple_combo("f8", function(){
        document.getElementById('cash').value = '';
        document.getElementById('cash').focus();
    })

    listener.simple_combo("shift c", function(){
        document.getElementById('cliente').value = '';
        document.getElementById('cliente').focus();
    })

    listener.simple_combo("shift c", function(){
        document.getElementById('cliente').value = '';
        document.getElementById('cliente').focus();
    })

    listener.simple_combo("shift e", function(){
        $('#exacto').click();
    })

    listener.simple_combo("shift a", function(){
        $('#agregar').click();
    })

    listener.simple_combo("shift b", function(){
        document.getElementById('boleta').value = '';
        document.getElementById('boleta').focus();
    })



    listener.simple_combo("f4", function(){
        var total = parseFloat(document.getElementById('hiddenTotal').value)

        if(total >0){
            Confirm(0, 'clearCart', 'Seguro de eliminar el carrito?')
        }else{
            noty('Agrege productos a la venta')
        }
    })

</script>
