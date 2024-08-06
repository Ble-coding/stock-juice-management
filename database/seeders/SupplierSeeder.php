<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\User;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Supplier::factory()->count(50)->create();
        $userIds = User::pluck('id')->toArray();

        // Récupérer tous les fournisseurs
        $suppliers = Supplier::all();

        // Parcourir tous les fournisseurs et leur assigner un user_id aléatoire existant
        foreach ($suppliers as $supplier) {
            $supplier->user_id = $userIds[array_rand($userIds)];
            $supplier->save();
        }
    }
}
