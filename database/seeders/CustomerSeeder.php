<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use App\Models\KycStatus;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $customers = Customer::all(); // Récupérer tous les clients existants

        // foreach ($customers as $customer) {
        //     // Vérifier et attribuer les valeurs si les champs sont vides

        //     if (empty($customer->code_customer)) {
        //         // Générer un code client unique aléatoire
        //         do {
        //             $randomNumber = rand(0, 999999); // Générer un nombre aléatoire entre 0 et 999999
        //             $newCode = 'UD' . str_pad($randomNumber, 6, '0', STR_PAD_LEFT); // Formatage en 6 chiffres avec préfixe 'UD'
        //         } while (Customer::where('code_customer', $newCode)->exists()); // Vérifier l'unicité du code

        //         $customer->code_customer = $newCode; // Attribuer le code client
        //     }

        //     if (is_null($customer->registered_at)) {
        //         $customer->registered_at = now(); // Date d'enregistrement actuelle
        //     }

        //     if (is_null($customer->kyc_status)) {
        //         $customer->kyc_status = KycStatus::PENDING; // Statut KYC par défaut
        //     }

        //     // Optionnel : Tu peux aussi définir un last_login si tu le souhaites
        //     if (is_null($customer->last_login)) {
        //         $customer->last_login = now(); // Ou une date spécifique si nécessaire
        //     }

        //     $customer->save(); // Enregistrer les modifications
        // }


        Customer::factory(50)->create();


        // $userIds = User::pluck('id')->toArray();

        // Récupérer tous les customers
        // $customers = Customer::all();

        // // Parcourir tous les customers et leur assigner un user_id aléatoire existant
        // foreach ($customers as $customer) {
        //     $customer->user_id = $userIds[array_rand($userIds)];
        //     $customer->save();
        // }
    }
}
