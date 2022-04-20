<ul class="navbar-item flex-row search-ul">
    <li class="nav-item align-self-center search-animated">
        <form class="form-inline search-full form-inline search" role="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <div class="search-bar ml-5">
                <select id="code" wire:keydown.enter.prevent="$emit('scan-code', $('#code').val())" class="form-control">
                    <option value="Elegir" disabled>Elegir</option>
                    @foreach ($data as $product)
                        <option value="{{$product->code}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </li>
</ul>


<script>
    document.addEventListener('DOMContentLoaded',function(){
        window.livewire.on('scan-code', action=>{
            $('#code').val('');
        });
    });

</script>
