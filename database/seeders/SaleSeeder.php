<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
// use App\Models\User;
use App\Models\Customer;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sale::factory(50)->create(); 
        // $userIds = User::pluck('id')->toArray();

        // // Récupérer tous les ventes
        // $sales = Sale::all();

        // // Parcourir tous les ventes et leur assigner un user_id aléatoire existant
        // foreach ($sales as $sale) {
        //     $sale->user_id = $userIds[array_rand($userIds)];
        //     $sale->save();
        // }



        // $customerIds = Customer::pluck('id')->toArray();

        // // Récupérer tous les ventes
        // $sales = Sale::all();

        // // Parcourir tous les ventes et leur assigner un customer_id aléatoire existant
        // foreach ($sales as $sale) {
        //     $sale->customer_id = $customerIds[array_rand($customerIds)];
        //     $sale->save();
        // }
    }
}
