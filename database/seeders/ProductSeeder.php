<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User; // Assurez-vous d'importer le modèle User si ce n'est pas déjà fait
use App\Models\Category;
use App\Models\Tag;

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

        Category::factory()->count(10)->create();

        // Crée des tags
        Tag::factory()->count(20)->create();

        // Crée des produits et attache des catégories et des tags
        Product::factory()->count(50)->create();

        // // Récupérer tous les IDs d'utilisateurs existants
        $userIds = User::pluck('id')->toArray();

        // Récupérer tous les produits
        $categories = Category::all();

        // Parcourir tous les produits et leur assigner un user_id aléatoire existant
        foreach ($categories as $category) {
            $category->user_id = $userIds[array_rand($userIds)];
            $category->save();
        }

         // Récupérer tous les IDs de categories existants
        //  $categoriesIds = Category::pluck('id')->toArray();

         // Récupérer tous les produits
         $tags = Tag::all();

         // Parcourir tous les produits et leur assigner un category_id aléatoire existant
         foreach ($tags as $tag) {
             $tag->user_id = $userIds[array_rand($userIds)];
             $tag->save();
         }
    }
}
