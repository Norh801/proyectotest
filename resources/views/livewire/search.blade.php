
<div>
<div class="col-sm-12 col-md-12">
    <div class="form-group">
        <select id="code" class="form-control nested" style="width:100%!important;">
            <div>
                @foreach ($data as $product)
                    <option value="{{$product->code}}">{{$product->name}}</option>
                @endforeach
            </div>
        </select>
    </div>
</div>
<div class="col-lg-12 col-sm-12 mb-3">
    <button wire:click.prevent="$emit('scan-code', $('#code').val())" type="button" class="btn btn-outline-dark mb-2" id="agregar">
        Agregar (Shift a)
    </button>
</div>
</div>
