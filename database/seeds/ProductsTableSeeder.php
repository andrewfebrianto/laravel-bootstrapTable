<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++){
            Product::create([
                'product_code' => 'K'.str_pad($i, 3, "0", STR_PAD_LEFT),
                'product_name'  => 'Item '.$i,
                'qty' => 5,
                'price' => 3000
            ]);
        }
    }
}
