
@include('common.modalHead')
<form>

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Charlie">
            @error('name')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Telefono:</label>
            <input type="text" wire:model.lazy="phone" class="form-control" placeholder="ej: 987654321" maxlength="9">
            @error('phone')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>email:</label>
            <input type="email" wire:model.lazy="email" class="form-control" placeholder="ej: oscar.grimaldo@gmail.com">
            @error('email')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Contrasña:</label>
            <input type="password" wire:model.lazy="password" class="form-control" >
            @error('password')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Estatus:</label>
            <select wire:model.lazy= 'status' class="form-control">
                <option value="Elegir" selected>Elegir</option>
                <option value="ACTIVE">Activo</option>
                <option value="LOCKED">Bloqueado</option>
            </select>
            @error('status')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Rol:</label>
            <select wire:model.lazy= 'profile' class="form-control">
                <option value="Elegir" selected>Elegir</option>
                @foreach ($roles as $rol)
                    <option value="{{$rol->id}}" selected>{{$rol->name}}</option>
                @endforeach
            </select>
            @error('profile')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Imagen de Perfil:</label>
            <input type="file" wire:model='image' accept="image/x-png, image/jpeg, image/jpg">
            @error('image')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>
</form>

@include('common.modalFooter')
