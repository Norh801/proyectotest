<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductsController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $code, $price, $stock, $alerts, $category_id, $search, $image, $selected_id,$pageTitle, $componentName;

    public $pagination=5;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->category_id= 'Elegir';
    }


    public function render()
    {
        if(strlen($this->search)>0){
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
                        ->select('products.*', 'c.name as category')
                        -> where('products.name', 'like', '%'.$this->search.'%')
                        -> orWhere('products.code', 'like', '%'.$this->search.'%')
                        -> orWhere('c.name', 'like', '%'.$this->search.'%')
                        -> orWhere('products.alerts', $this->search)
                        ->orderBy('products.name', 'asc')
                        ->paginate($this->pagination);
        }else{
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
            ->select('products.*', 'c.name as category')
            -> orderBy('products.name', 'asc')
            ->paginate($this->pagination);
        }
        return view('livewire.products.products', [
            'data' => $products,
            'categories' => Category::orderBy('name', 'asc')->get()
        ])->extends('layouts.theme.app')
        ->section('content');;
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:products|min:3|regex:/^[\pL\s0-9\-]+$/u',
            'price' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'category_id' => 'required|not_in:Elegir',
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'name.unique' => 'El producto ya existe',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.regex' => 'Solo se aceptan letras y espacios',

            'price.required' => 'El precio del producto es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'El Inv. Minimo es requerido',
            'category_id.required' => 'El nombre de la categoria es requerido',
            'category_id.not_in' => 'Elige un nombre de categoria diferente de Elegir',
        ];

        $this->validate($rules, $messages);


        $product  = Product::create([
            'name' => $this->name,
            'code' => $this->code,
            'price' => $this->price,

            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'category_id' => $this->category_id,
        ]);

        if($this->image)
        {
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/products', $customFileName);
            $product->image = $customFileName;
            $product->save();
        }
        $this->resetUI();
        $this->emit('product-added', 'Producto registrado');
    }

    public function Edit(Product $product){
        $this->selected_id = $product->id;
        $this->name = $product->name;
        $this->code = $product->code;
        $this->price = $product->price;
        $this->stock= $product->stock;

        $this->alerts = $product->alerts;
        $this->category_id = $product->category_id;
        $this->image=null;

        $this->emit('modal-show', 'Show Modal');
    }

    public function Update()
    {
        $rules = [
            'name' => "required|min:3|regex:/^[\pL\s0-9\-]+$/u|unique:products,name,{$this->selected_id}",
            'price' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'category_id' => 'required|not_in:Elegir',
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'name.unique' => 'El producto ya existe',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.regex' => 'Solo se aceptan letras y espacios',

            'price.required' => 'El precio del producto es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'El Inv. Minimo es requerido',
            'category_id.required' => 'El nombre de la categoria es requerido',
            'category_id.not_in' => 'Elige un nombre de categoria diferente de Elegir',
        ];

        $this->validate($rules, $messages);

        $product = Product::find($this->selected_id);
        $product->update([
            'name' => $this->name,
            'code' => $this->code,
            'price' => $this->price,

            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'category_id' => $this->category_id,
        ]);

        if($this->image)
        {
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/products', $customFileName);
            $imageTemp = $product->image;
            $product->image = $customFileName;

            $product->save();

            if($imageTemp !=null)
            {
                if(file_exists('storage/products/'.$imageTemp)){
                    unlink('storage/products/'.$imageTemp);
                }
            }
        }
        $this->resetUI();
        $this->emit('product-updated', 'Producto registrado');
    }



    public function resetUI()
    {
        $this->name='';
        $this->code='';
        $this->price='';
        $this->stock='';
        $this->alerts='';
        $this->search='';
        $this->category_id='Elegir';
        $this->image=null;
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Product $product)
    {
        $imageTemp = $product->image;
        $product->delete();

        if($imageTemp !=null)
        {
            if(file_exists('storage/products/'.$imageTemp)){
                unlink('storage/products/'.$imageTemp);
            }
        }

        $this->resetUI();
        $this->emit('product-deleted', 'Producto Eliminado');
    }
}
