<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Historique;

class HistoriqueSeeder extends Seeder
{
    public function run(): void
    {
        Historique::create([
            'employe_id' => 1,
            'type_action' => 'Ajout d’une cuve',
            'date_action' => now(),
        ]);

        Historique::create([
            'employe_id' => 2,
            'type_action' => 'Modification d’un moût',
            'date_action' => now(),
        ]);
    }
}
