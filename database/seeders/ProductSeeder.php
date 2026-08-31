<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Base Líquida',
            'description' => 'Base líquida de alta cobertura',
            'price' => 49.99,
            'category_id' => 1,
            'quantity' => 100,
            'minimum_stock' => 10,
            'image' => 'products/base-liquida.jpg'
        ]);

        Product::create([
            'name' => 'Shampoo Relâmpago McQueen',
            'description' => 'Shampoo Relampago McQueen para cabelos brilhantes e rápidos',
            'price' => 29.99,
            'category_id' => 2,
            'quantity' => 50,
            'minimum_stock' => 5,
            'image' => 'products/relampago-mcqueen.jpg'
        ]);
    }
}
