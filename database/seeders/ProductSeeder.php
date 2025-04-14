<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Glamour Herbal Shampoo',
            'price' => 299,
            'category' => 'special',
            'image' => 'images/products/shampoo.jpg',
        ]);

        Product::create([
            'name' => 'L’Oreal Hair Serum',
            'price' => 499,
            'category' => 'others',
            'image' => 'images/products/serum.jpg',
        ]);

        Product::create([
            'name' => 'Glamour Natural Face Pack',
            'price' => 199,
            'category' => 'special',
            'image' => 'images/products/facepack.jpg',
        ]);

        Product::create([
            'name' => 'Nivea Body Lotion',
            'price' => 249,
            'category' => 'others',
            'image' => 'images/products/lotion.jpg',
        ]);
    }
}
