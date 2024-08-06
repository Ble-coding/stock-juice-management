<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User; // Assurez-vous d'importer le modèle User si ce n'est pas déjà fait

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory()->count(50)->create();

        // Récupérer tous les IDs d'utilisateurs existants
        $userIds = User::pluck('id')->toArray();

        // Récupérer tous les produits
        $products = Product::all();

        // Parcourir tous les produits et leur assigner un user_id aléatoire existant
        foreach ($products as $product) {
            $product->user_id = $userIds[array_rand($userIds)];
            $product->save();
        }
    }
}
