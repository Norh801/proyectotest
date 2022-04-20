<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;

class SearchController extends Component
{
    public $search;

    public function render()
    {
        $products = Product::join('categories as c', 'c.id', 'products.category_id')
                        ->select('products.*', 'c.name as category')->orderBy('products.name', 'asc')
                        ->get();
        return view('livewire.search', [
            'data' => $products]);
    }

}
