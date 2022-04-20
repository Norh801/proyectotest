<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="theModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content ">
        <div class="modal-header" style="background-color: #e7515a;">
          <h5 class="modal-title text-white">
              <b>{{$componentName}}</b>  |  {{$selected_id > 0 ? 'Editar' :  'Crear'}}
          </h5>
          <h6 class="text-center text-warning" wire:loading>
              POR FAVOR ESPERE
          </h6>
        </div>
        <div class="modal-body">
