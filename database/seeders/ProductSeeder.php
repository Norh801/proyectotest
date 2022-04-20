<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'name'=>'Cerveza Pilsen Callao Six Pack Lata 355 ml',
            'code'=>1,
            'price'=>20.90,
            'stock'=>10,
            'alerts'=>3,
            'image'=>'cerveza.png',
            'category_id'=>1,
        ]);

        Product::create([
            'name'=>'Whisky Chivas Regal Extra 13 Años 700 ml',
            'code'=>2,
            'price'=>94.90,
            'stock'=>30,
            'alerts'=>12,
            'image'=>'whisky.png',
            'category_id'=>2,
        ]);

        Product::create([
            'name'=>'Ron Flor de Caña Oro 4 Años 750 ml',
            'code'=>3,
            'price'=>40.90,
            'stock'=>30,
            'alerts'=>12,
            'image'=>'Ron.png',
            'category_id'=>3,
        ]);

        Product::create([
            'name'=>'Vino Casillero del Diablo Cabernet Sauvignon 750 ml',
            'code'=>4,
            'price'=>39.90,
            'stock'=>30,
            'alerts'=>12,
            'image'=>'Vino.png',
            'category_id'=>4,
        ]);

        Product::create([
            'name'=>'Pisco Acholado Tabernero 700 ml',
            'code'=>5,
            'price'=>32.90,
            'stock'=>30,
            'alerts'=>12,
            'image'=>'Pisco.png',
            'category_id'=>5,
        ]);
        
    }
}
