<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>


<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>

<script src="https://unpkg.com/currency.js@2.0.4/dist/currency.min.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->



<script>
    function noty(msg, option=1){
        Snackbar.show({
            text:msg.toUpperCase(),
            actionText: "CERRAR",
            actionTextColor: '#FFF',
            backgroundColor: option==1 ? '#3b3f5c' : "#e7515a",
            pos: 'top-right'

        });
    }
</script>



<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>

@livewireScripts


