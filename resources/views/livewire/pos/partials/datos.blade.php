<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">
                Datos:
            </h5>

            <div class="connect-sorting-content mt-4">
                <div class="card simple-title-talk ui-sortable-handle">
                    <div class="card-body">
                        <div class="input-group input-group-md mb-3">
                            <span class="input-group-text" >Nro Boleta: </span>

                            <input type="text" id="cash" wire:model='code' class="form-control">
                        </div>

                        <div class="input-group input-group-md mb-3">
                            <span class="input-group-text" >Cliente: </span>

                            <input type="text" id="cash" wire:model='customer' class="form-control">
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-9 col-md-12 col-sm-12  mb-3">
                                <div class="input-group input-group-md mb-3 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp" style="background-color: #3b3f5c; color: white">
                                            Efectivo
                                        </span>
                                    </div>
                                    <input type="tel" id="cash" wire:model="efectivo" class="form-control text-center" value=' '>
                                    <div class="input-group-append">
                                        <span wire:click="$set('efectivo',0)" class="input-group-text" style="background-color: #3b3f5c; color: white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 mb-3">
                                <button wire:click.prevent="ACash({{$value=0}})" type="button" class="btn btn-outline-dark mb-2">
                                    Exacto
                                </button>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
