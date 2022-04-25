<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget-heading">
            <h4 class="card-title text-center">
                <b>{{$componentName}}</b>
            </h4>
        </div>
        <div class="widget-content">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Elige el usuario</h6>
                            <div class="form-group">
                                <select class="form-control" wire:model='userId'>
                                    <option value="0">Todos</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6>Elige el tipo de reporte</h6>
                            <div class="form-group">
                                <select class="form-control" wire:model='reportType'>
                                    <option value="0">Ventas del dia</option>
                                    <option value="1">Ventas por fecha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <h6>Fecha desde:</h6>
                            <input type="text" wire:model='dateFrom' class="form-control flatpickr" placeholder="Click para elegir">
                        </div>
                        <div class="col-sm-12 mt-2">
                            <h6>Fecha hasta:</h6>
                            <input type="text" wire:model='dateTo' class="form-control flatpickr" placeholder="Click para elegir">
                        </div>
                        <div class="col-sm-12 mt-5">
                            <button class="btn btn-dark btn-block" wire:click='$refresh'>Consultar</button>
                            <a class="btn btn-dark btn-block {{count($data) < 1 ? 'disabled' : ''}}" href="{{url('report/pdf'. '/'. $userId.'/'.$reportType.'/'.$dateFrom.'/'.$dateTo)}}" target="_blank">Generar pdf</a>
                            <a class="btn btn-dark btn-block {{count($data) < 1 ? 'disabled' : ''}}" href="{{url('report/excel'. '/'. $userId.'/'.$reportType.'/'.$dateFrom.'/'.$dateTo)}}" target="_blank">Exportar a Excel</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="table-th text-center text-white">Folio</th>
                                    <th class="table-th text-center text-white">Total</th>
                                    <th class="table-th text-center text-white">Items</th>
                                    <th class="table-th text-center text-white">Estatus</th>
                                    <th class="table-th text-center text-white">Usuario</th>
                                    <th class="table-th text-center text-white">Fecha</th>
                                    <th class="table-th text-center text-white" width='50px'></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data)<1)
                                    <tr><td colspan="7"><h5 class="text-center">Sin resultados</h5></td></tr>
                                @endif
                                @foreach ($data as $d)
                                    <tr>
                                        <td class="text-center"><h6>{{$d->id}}</h6></td>
                                        <td class="text-center"><h6>S/. {{number_format($d->total,2)}}</h6></td>
                                        <td class="text-center"><h6>{{$d->items}}</h6></td>
                                        <td class="text-center"><h6>{{$d->user}}</h6></td>
                                        <td class="text-center">
                                            <h6>
                                                {{\Carbon\Carbon::parse($d->created_at)->format('d-m-Y')}}
                                            </h6>
                                        </td>
                                        <td class="text-center" width="50px"">
                                            <button wire:click.prevent= 'getDetails({{$d->id}})' class="btn btn-dark btn-sm">
                                                <i class="fas fa-list"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.reports.sales-detail')


    <script>
        document.addEventListener('DOMContentLoaded', function(){
            flatpickr(document.getElementsByClassName('flatpickr'),{
                enableTime: false,
                dateFormat: 'Y-m-d',
                locale: {
                    firstDayofWeek: 1,
                    weekdays: {
                        shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado",
                            ],
                    },

                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dic",
                        ],
                            longhand: [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre",
                        ],
                    },

                }
            })

            window.livewire.on('show-modal', msg =>{
                $('#modalDetails').modal('show')
            })
        })
    </script>
</div>
