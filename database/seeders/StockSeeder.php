<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
// use App\Models\User;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Stock::factory()->count(50)->create();


        // $userIds = User::pluck('id')->toArray();

        // // Récupérer tous les stocks
        // $stocks = Stock::all();

        // // Parcourir tous les stocks et leur assigner un user_id aléatoire existant
        // foreach ($stocks as $stock) {
        //     $stock->user_id = $userIds[array_rand($userIds)];
        //     $stock->save();
        // }



        $supplierIds = Supplier::pluck('id')->toArray();

        // Récupérer tous les stocks
        $stocks = Stock::all();

        // Parcourir tous les stocks et leur assigner un supplier_id aléatoire existant
        foreach ($stocks as $stock) {
            $stock->supplier_id = $supplierIds[array_rand($supplierIds)];
            $stock->save();
        }
    }
}
