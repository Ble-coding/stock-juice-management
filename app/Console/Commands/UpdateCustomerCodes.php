<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;

class UpdateCustomerCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:update-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all customer codes to unique random codes, except for ID 1';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customers = Customer::where('code_customer', 'UD000001')
                             ->where('id', '!=', 1)
                             ->get(); // Récupérer tous les clients avec le code UD000001 sauf ID 1

        foreach ($customers as $customer) {
            // Générer un code client unique aléatoire
            do {
                $randomNumber = rand(0, 999999); // Générer un nombre aléatoire entre 0 et 999999
                $newCode = 'UD' . str_pad($randomNumber, 6, '0', STR_PAD_LEFT); // Formatage en 6 chiffres avec préfixe 'UD'
            } while (Customer::where('code_customer', $newCode)->exists()); // Vérifier l'unicité du code

            $customer->code_customer = $newCode; // Attribuer le nouveau code client
            $customer->save(); // Enregistrer les modifications
        }

        $this->info('Customer codes updated successfully!');
    }
}
