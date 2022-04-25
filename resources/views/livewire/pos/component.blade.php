<div>
<style></style>


<div class="row layout-top-spacing toScroll">
    <div class="col-sm-12 col-md-6">
        <!--Datos-->
        @include('livewire.pos.partials.datos')
    </div>
    <div class="col-sm-12 col-md-6">
        <!--Total-->
        @include('livewire.pos.partials.total')
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!--Detalles-->
        @include('livewire.pos.partials.detail')
    </div>

</div>

@include('livewire.pos.scripts.events')
@include('livewire.pos.scripts.general')
@include('livewire.pos.scripts.shorcuts')
</div>



