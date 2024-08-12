<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Produit;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Produit::create([
            'nom' => 'Produit 1',
            'prix' => 10.99,
            'image' => "img1",
        ]);

        Produit::create([
            'nom' => 'Produit 2',
            'prix' => 20.99,
            'image' => "img2",
        ]);

        // Add more products as needed
    }
}

