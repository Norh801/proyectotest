        </div>
      <div class="modal-footer">
          <button type="button" wire:click.prevent="resetUI()" class="btn close-btn text-white" data-dismiss="modal" style="background-color:#e7515a; color: white;">
              CERRAR
          </button>

          @if ($selected_id < 1)
            <button type="button" wire:click.prevent="Store()" class="btn close-modal"  style="background-color:#009688; color: white;">
                GUARDAR
            </button>
          @else
            <button type="button" wire:click.prevent="Update()" class="btn close-modal" style="background-color:#fc9842; color: white;">
                ACTUALIZAR
            </button>
          @endif
      </div>
    </div>
  </div>
</div>
