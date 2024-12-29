<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            CuveSeeder::class,
            MoutSeeder::class,
            ProprietaireSeeder::class,
            ParcelleSeeder::class,
            EmployeSeeder::class,
            RoleSeeder::class,
            HistoriqueSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            RoleSeeder::class, 
            UserSeeder::class,
        ]);
    }
}
