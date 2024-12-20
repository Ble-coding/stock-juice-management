<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Fournisseur'],
            ['name' => 'Client'],
            // Ajoutez d'autres rôles si nécessaire en fonction de l'appli
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
