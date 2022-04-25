<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="modalDetails">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content ">
        <div class="modal-header" style="background-color: #e7515a;">
          <h5 class="modal-title text-white">
              <b>Detalle de Venta {{$saleId}}</b>
          </h5>
          <h6 class="text-center text-warning" wire:loading>
              POR FAVOR ESPERE
          </h6>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3B3F5C">
                        <tr>
                            <th class="table-th text-center text-white">Id</th>
                            <th class="table-th text-center text-white">Producto</th>
                            <th class="table-th text-center text-white">Cantidad</th>
                            <th class="table-th text-center text-white">Precio</th>
                            <th class="table-th text-center text-white">Importe</th>                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($details as $d)
                            <tr>
                                <td class="text-center"><h6>{{$d->id}}</h6></td>
                                <td class="text-center"><h6>{{$d->product}}</h6></td>
                                <td class="text-center"><h6>{{$d->quantity}}</h6></td>
                                <td class="text-center"><h6>S/. {{number_format($d->price,2)}}</h6></td>
                                <td class="text-center"><h6>S/. {{number_format($d->quantity*$d->price,2)}}</h6></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <td class="text-center" colspan="2">
                            <h6 class="text-info">Totales:</h6>
                        </td>
                        <td class="text-center">
                                <h6 class="text-info">{{$countDetails}}</h6>
                        </td>
                        <td></td>

                            <td class="text-center"><h6 class="text-info">
                                S/. {{number_format($sumDetails,2)}}
                            </h6></td>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button"  class="btn close-btn text-white" data-dismiss="modal" style="background-color:#e7515a; color: white;">
                CERRAR
            </button>
        </div>
      </div>
    </div>
  </div>
