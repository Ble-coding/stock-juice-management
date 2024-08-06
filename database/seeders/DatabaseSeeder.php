<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Appelle le seeder pour les produits
        // $this->call(ProductSeeder::class);

        // Appelle le seeder pour les fournisseurs
        // $this->call(SupplierSeeder::class);

        // $this->call([
        //     StockSeeder::class,
        // ]);
        
        // $this->call([
        //     CustomerSeeder::class,
        //     SaleSeeder::class,
        // ]);

        $this->call([
            // RoleSeeder::class, // Crée les rôles
            // UserSeeder::class, // Utilisateurs existants
            RoleUserSeeder::class, // Associe les rôles aux utilisateurs
        ]);

        
    }
}
