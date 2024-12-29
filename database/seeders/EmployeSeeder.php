<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employe;

class EmployeSeeder extends Seeder
{
    public function run(): void
    {
        Employe::create([
            'nom' => 'Jean Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'role_id' => 1,
        ]);

        Employe::create([
            'nom' => 'Marie Dubois',
            'prenom' => 'Marie',
            'email' => 'marie.dubois@example.com',
            'role_id' => 2,
        ]);
    }
}
