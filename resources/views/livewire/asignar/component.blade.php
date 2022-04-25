<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chat-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{$componentName}}</b>
                </h4>


            </div>

            <div class="widget-content widget-content-area">
                <div class="form-inline">
                    <div class="form-group mr-5">
                        <div>
                            <select wire:model='role' class="form-control">
                                <option value="Elegir" selected>== Selecciona el Rol ==</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div>
                        <button wire:click.prevent='SyncAll()' class="btn btn-dark mbmobile inblock mr-5">Sincronizar Todos</button>

                    </div>
                    <div>
                        <button onclick='Revocar()' class="btn btn-dark mbmobile inblock mr-5">Revocar Todos</button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <div id="style-3_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="dt--top-section">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center">
                                                <div class="dataTables_length" id="style-3_length">
                                                    <label>Results :
                                                        <div>
                                                            <select wire:model="pagination" name="style-3_length" aria-controls="style-3" class="form-control">
                                                                <option value="5">5</option>
                                                                <option value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="50">50</option>
                                                            </select>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3">
                                                <div id="style-3_filter" class="dataTables_filter">
                                                    <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                        <div><input wire:model.debounce.500ms="search" type="search" class="form-control" placeholder="Search..." aria-controls="style-3" ></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="style-3" class="table style-3  table-hover">
                                        <thead>
                                            <tr>
                                                <th class="checkbox-column text-center"> Record Id </th>
                                                <th class="text-center">Permiso</th>
                                                <th class="text-center dt-no-sorting">Roles con el permiso</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div>
                                            @foreach ($permisos as $permiso)
                                                <tr>
                                                    <td><h6 class="text-center">{{$permiso->id}}</h6></td>
                                                    <td class="text-center">
                                                        <div class="n-check">
                                                            <label class="new-control new-checkbox checkbox-primary">

                                                                <input type="checkbox"
                                                                wire:change="SyncPermiso($('#p'+{{$permiso->id}}).is(':checked'), '{{$permiso->name}}')"
                                                                id="p{{$permiso->id}}"
                                                                value="{{$permiso->id}}"
                                                                class="new-control-input"
                                                                {{$permiso->checked==1 ? 'checked' : ''}}
                                                                >

                                                                <span class="new-control-indicator"></span>
                                                                <h6>{{$permiso->name}}</h6>

                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6>{{\App\Models\User::permission($permiso->name)->count()}}</h6>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </div>
                                        </tbody>
                                    </table>
                                    {{$permisos->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            window.livewire.on('sync-error', Msg => {
                noty(Msg)
            })
            window.livewire.on('permi', Msg => {
                noty(Msg)
            })
            window.livewire.on('syncall', Msg => {
                noty(Msg)
            })
            window.livewire.on('removeall', Msg => {
                noty(Msg)
            })
        });

        function Revocar()
        {
            swal({
                type: 'warning',
                title: 'Confirmar',
                text: '¿Confirmas revocar todos los permisos?',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#e7515a',
                confirmButtonColor: '#009688',
                confirmButtonText: 'Aceptar',
            }).then(function(result){
                if(result.value){
                    window.livewire.emit('revokeall')
                    swal.close()
                }
            })
        }
    </script>
</div>


