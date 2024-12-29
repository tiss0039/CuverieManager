<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mout;

class MoutSeeder extends Seeder
{
    public function run(): void
    {
        Mout::create([
            'volume' => 500,
            'type' => 'Chardonnay',
            'proprietaire_id' => 1,
            'parcelle_id' => 1,
            'cuve_id' => 1,
        ]);

        Mout::create([
            'volume' => 300,
            'type' => 'Pinot Noir',
            'proprietaire_id' => 2,
            'parcelle_id' => 2,
            'cuve_id' => 2,
        ]);
    }
}