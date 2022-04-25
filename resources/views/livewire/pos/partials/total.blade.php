<div class="row">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting">
                <h5 class="text-center mb-3">Resumen de Venta</h5>
                <div class="connect-sorting-content">
                    <div class="card simple-title-talk ui-sortable-handle">
                        <div class="card-body">
                            <div class="task-header">

                                <div class="row justify-content-between mt-5">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h2>Total: S/.{{number_format($total,2)}}</h2>
                                        <input type="hidden" id="hiddenTotal" value="{{$total}}">
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <h4 class="mt-3">Articulos: {{$itemsQuantity}}</h4>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <h4 class="mt-3">Cambio S/.{{number_format($change,2)}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between mt-5">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @if ($total>0)
                                        <button onclick="Confirm('','clearCart','¿Seguro de eliminar el carrito?')" class="btn btn-dark mtmobile">
                                            Cancelar (F4)
                                        </button>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @if ($efectivo>=$total && $total>0)
                                        <button wire:click.prevent='saveSale' class="btn btn-dark btn-md btn-block">
                                            Guardar (F9)
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
