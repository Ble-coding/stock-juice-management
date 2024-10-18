<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(10)->create(); // Créer 10 catégories

        // Category::create(['name' => 'Électronique', 'description' => 'Produits électroniques']);
        // Category::create(['name' => 'Vêtements', 'description' => 'Vêtements et accessoires']);
        // Category::create(['name' => 'Maison', 'description' => 'Articles pour la maison']);

        $userIds = User::pluck('id')->toArray();

        // Récupérer tous les customers
        $categories = Category::all();

        // Parcourir tous les customers et leur assigner un user_id aléatoire existant
        foreach ($categories as $categorie) {
            $categorie->user_id = $userIds[array_rand($userIds)];
            $categorie->save();
        }
    }
}
