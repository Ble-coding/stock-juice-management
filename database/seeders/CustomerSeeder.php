<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Customer::factory(50)->create();
        $userIds = User::pluck('id')->toArray();

        // Récupérer tous les customers
        $customers = Customer::all();

        // Parcourir tous les customers et leur assigner un user_id aléatoire existant
        foreach ($customers as $customer) {
            $customer->user_id = $userIds[array_rand($userIds)];
            $customer->save();
        }
    }
}
