
<div class="row layout-spacing mt-5">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{$componentName}} | {{$pageTitle}} </b>
                </h4>
                <br>
                <ul class="tabs tabs-pills" style="list-style-type:none;">
                    <li>
                        <a href="javascript:void(0)" class="btn btn-outline-success btn-rounded mb-2" data-toggle="modal" data-target="#theModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                            Agregar
                        </a>
                    </li>
                </ul>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <div id="style-3_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="dt--top-section">
                            <div class="row">
                                <div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center">
                                    <div class="dataTables_length" id="style-3_length">
                                        <label>Results :
                                            <select wire:model="pagination" name="style-3_length" aria-controls="style-3" class="form-control">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3">
                                    <div id="style-3_filter" class="dataTables_filter">
                                        <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                            <input wire:model.debounce.500ms="search" type="search" class="form-control" placeholder="Search..." aria-controls="style-3" >
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="style-3" class="table style-3  table-hover">
                                <thead>
                                    <tr>
                                        <th class="checkbox-column text-center"> Id </th>
                                        <th>Descripción</th>
                                        <th class="text-center dt-no-sorting">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div>
                                    @foreach ($roles as $rol)


                                    <tr>
                                        <td class="checkbox-column text-center"> {{$rol->id}} </td>
                                        <td><h6>{{$rol->name}}</h6></td>
                                        <td class="text-center">
                                            <ul class="table-controls">
                                                <li><a href="javascript:void(0);"
                                                    wire:click="Edit({{$rol->id}})"
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                                    <li><a href="javascript:void(0);"
                                                    onclick="Confirm('{{$rol->id}}')"
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </div>
                                </tbody>

                            </table>
                        </div>
                        {{$roles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.roles.form')

<script>
    document.addEventListener('DOMContentLoaded',function(){
        window.livewire.on('role-added', msg=>{
            $('#theModal').modal('hide');
            noty(msg)
        });
        window.livewire.on('role-updated', msg=>{
            $('#theModal').modal('hide');
            noty(msg)
        });

        window.livewire.on('role-deleted', msg=>{
            noty(msg)
        });
        window.livewire.on('role-exist', msg=>{
            noty(msg)
        });
        window.livewire.on('role-error', msg=>{
            $('#theModal').modal('hide');
            noty(msg)
        });
        window.livewire.on('hide-modal', msg=>{
            $('#theModal').modal('hide');
        });
        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show');

        });
    });

    function Confirm(id)
    {
        swal({
            type: 'warning',
            title: 'Confirmar',
            text: '¿Deseas eliminar el rol?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#e7515a',
            confirmButtonColor: '#009688',
            confirmButtonText: 'Aceptar',
        }).then(function(result){
            if(result.value){
                window.livewire.emit('destroy', id)
                swal.close()
            }
        })
    }
</script>

</div>

