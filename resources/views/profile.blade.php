@extends('layouts.theme.app')

@section('content')
<div class="row layout-spacing mt-5">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <form id="general-info" class="section general-info mt-5">
                    <div class="info">
                        <h6 class="">General Information</h6>
                        <div class="row" style="padding: 25px">
                            <div class="col-lg-11 mx-auto">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-12 col-md-8">
                                        <div class="upload mt-4 pr-md-8">
                                            <img src="{{asset('storage/users/'. Auth()->user()->image)}}" class="img-fluid mr-2" alt="avatar">
                                        </div>
                                    </div>

                                    <div class="row ml-5">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Nombre:</label>
                                                <input type="text"  class="form-control" placeholder="{{Auth()->user()->name}}" disabled>

                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Telefono:</label>
                                                <input type="text" class="form-control" placeholder="{{Auth()->user()->phone}}" maxlength="9" disabled>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input type="email"  class="form-control" placeholder="{{Auth()->user()->email}}" disabled>

                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Asignar Rol:</label>
                                                <input type="text"  placeholder="{{ Spatie\Permission\Models\Role::find(Auth()->user()->profile)->name}}"  class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
