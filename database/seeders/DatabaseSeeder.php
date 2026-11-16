<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ordre respectant les clés étrangères (compatible MySQL et SQLite,
        // sans désactiver les contraintes) : chaque table référencée est
        // remplie avant les tables qui la référencent.
        $this->call([
            RoleSeeder::class,
            ProprietaireSeeder::class,
            ParcelleSeeder::class,
            CuveSeeder::class,
            MoutSeeder::class,
            EmployeSeeder::class,
            HistoriqueSeeder::class,
            UserSeeder::class,
        ]);
    }
}
