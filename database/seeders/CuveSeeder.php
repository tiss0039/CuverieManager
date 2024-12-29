<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cuve;

class CuveSeeder extends Seeder
{
    public function run(): void
    {
        Cuve::create([
            'nom' => 'Cuve 1',
            'volume_maximum' => 1000,
        ]);

        Cuve::create([
            'nom' => 'Cuve 2',
            'volume_maximum' => 1500,
        ]);

        Cuve::create([
            'nom' => 'Cuve 3',
            'volume_maximum' => 2000,
        ]);
    }
}
