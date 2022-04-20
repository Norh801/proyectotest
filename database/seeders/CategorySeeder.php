<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name'=> 'Cerveza', 
        ]);
        Category::create([
            'name'=> 'Whisky', 
        ]);
        Category::create([
            'name'=> 'Ron', 
        ]);
        Category::create([
            'name'=> 'Vino', 
        ]);
        Category::create([
            'name'=> 'Pisco', 
        ]);
        

    }
}
