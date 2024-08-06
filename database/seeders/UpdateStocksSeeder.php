<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Product;
use Faker\Factory as Faker;


class UpdateStocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Récupérer tous les produits existants
        //  $products = Product::all();

        //  // Parcourir les 50 premiers enregistrements de stocks à mettre à jour
        //  $stocksToUpdate = Stock::take(50)->get();
 
        //  // Itérer à travers les stocks et leur attribuer un product_id existant
        //  foreach ($stocksToUpdate as $stock) {
        //      $randomProduct = $products->random();
        //      $stock->product_id = $randomProduct->id;
        //      $stock->save();
        //  }


        
        $faker = Faker::create();

        // Récupérer les 100 premiers enregistrements de stocks à mettre à jour
        $stocksToUpdate = Stock::take(100)->get();

        // Itérer à travers les stocks et leur attribuer un prix aléatoire entre 50 et 1,000,000 FCFA
        foreach ($stocksToUpdate as $stock) {
            $stock->update([
                'price' => $faker->randomFloat(2, 50, 1000000)
            ]);
        }
    }
}
