@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Smirnoff 500ml">
            @error('name')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Código:</label>
            <input type="text" wire:model.lazy="code" class="form-control" placeholder="ej: 12345">
            @error('code')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Precio:</label>
            <input type="text" data-type='currency' wire:model.lazy="price" class="form-control" placeholder="ej: 0.00">
            @error('price')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Stock:</label>
            <input type="number"  wire:model.lazy="stock" class="form-control" placeholder="ej: 0">
            @error('stock')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Inv. Mínimo:</label>
            <input type="number" wire:model.lazy="alerts" class="form-control" placeholder="ej: 10">
            @error('alerts')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Categoría</label>
            <select wire:model="category_id" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <label>Imagen</label>
        <div class="form-group custom-file">

            <input type="file" class="custom-file-input form-control" wire:model="image"
                accept="image/x-png,image/jpeg,/imagejpg"
            >
            <label class="custom-file-label">Imagen {{$image}}</label>
            @error('image')
                <span class="text-danger er">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>







@include('common.modalFooter')
