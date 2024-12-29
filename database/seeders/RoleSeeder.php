<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['nom_role' => 'Administrateur']);
        Role::create(['nom_role' => 'Manager']);
        Role::create(['nom_role' => 'Caviste']);
    }
}
