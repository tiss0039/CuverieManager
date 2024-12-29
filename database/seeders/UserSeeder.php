<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('nom_role', 'Administrateur')->first();
        $managerRole = Role::where('nom_role', 'Manager')->first();
        $cavisteRole = Role::where('nom_role', 'Caviste')->first();

        // Supprimer les utilisateurs existants avant de les recréer
        User::truncate();

        // Ajout d'utilisateurs uniques
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $managerRole->id,
        ]);

        User::create([
            'name' => 'Caviste User',
            'email' => 'caviste@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $cavisteRole->id,
        ]);

    }
}
