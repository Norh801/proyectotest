<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PosController extends Component
{
    public $total,$itemsQuantity,$efectivo,$change, $customer, $code;


    public function mount()
    {

        $this->efectivo=0;

        $this->total= Cart::getTotal();
        $this->change= 0;
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function setZero(){
        $this->efectivo=0;
        $this->change=0;
    }


    public function render()
    {

        if($this->efectivo > 0){
            if($this->efectivo - $this->total <=0){
                $this->change = 0;
            }else{
                $this->change =$this->efectivo - $this->total;
            }
        }
        return view('livewire.pos.component', ['cart' => Cart::getContent()->sortBy('name')])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function ACash($value){
        if($value ==0){
            $this->efectivo = number_format($this->total,2);
            $this->change=0;
        }

    }

    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale'
    ];

    public function ScanCode($code, $cant =1)
    {

        $product = Product::where('code', $code)->first();

        if($product==null)
        {
            $this->emit('scan-notfound', 'El producto no esta registrado');
        }else{
            if($this->InCart($product->id))
            {
                $this->increaseQty($product->id);
                return;
            }

            if($product->stock <1)
            {
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }



            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', 'Producto agregado');
        }
    }

    public function InCart($productId)
    {
        $exist = Cart::get($productId);
        if($exist){
            return true;
        }else{
            return false;
        }
    }

    public function increaseQty($productId, $cant=1){
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist){
            $title = 'Cantidad actualizada';
        }else{
            $title = 'Producto agregado';
        }
        if($exist){
            if($product->stock < ($cant + $exist->quantity)){
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }
        }

        Cart::add($product->id, $product->name, $product->price, $cant, $product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', $title);
    }

    public function updateQty($productId, $cant =1)
    {
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist){
            $title = 'Cantidad actualizada';
        }else{
            $title = 'Producto agregado';
        }

        if($exist)
        {
            if($product->stock < $cant){
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }
        }

        $this->removeItem($productId);

        if($cant>0)
        {
            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $title);
        }
    }

    public function removeItem($productId)
    {
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
    }

    public function decreaseQty($productId)
    {
        $item = Cart::get($productId);
        Cart::remove($productId);


        $newQty = ($item->quantity) -1;

        if($newQty >0){
            Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);
        }


        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto actualizada');
    }

    public function clearCart()
    {
        Cart::clear();
        $this->efectivo=0;
        $this->change=0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Carrito Vacio');
    }

    public function saveSale(){
        if($this->total <=0)
        {
            $this->emit('sale error', 'Agrega productos a la venta');
            return;
        }

        if($this->efectivo <=0){
            $this->emit('sale error', 'Ingresa el efectivo');
            return;
        }
        if($this->total > $this->efectivo){
            $this->emit('sale error', 'El efectivo es insuficiente');
            return;
        }

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id,
                'customer' => $this->customer,
                'code' =>$this->code,
                'tax'=>$this->total*0.18,

            ]);

            if($sale){
                $items = Cart::getContent();
                foreach ($items as $item) {
                    # code...
                    SaleDetail::create([
                        'price' =>$item->price,
                        'quantity' =>$item->quantity,
                        'product_id' =>$item->id,
                        'sale_id' =>$sale->id,
                    ]);

                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;

                    $product->save();

                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo=0;
            $this->change=0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('sale-ok', 'Venta registrada con exito');

        } catch (Exception $e) {
            //throw $th;
            DB::rollBack();
            $this->emit('sale-error', $e->getMessage());

        }
    }

    public function printTicket($sale){
        return Redirect::to("print://$sale->id");
    }
}
