<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parcelle;

class ParcelleSeeder extends Seeder
{
    public function run(): void
    {
        Parcelle::create([
            'nom_parcelle' => 'Parcelle 1',
            'localisation_parcelle' => 'Nord',
            'proprietaire_id' => 1,
        ]);

        Parcelle::create([
            'nom_parcelle' => 'Parcelle 2',
            'localisation_parcelle' => 'Est',
            'proprietaire_id' => 2,
        ]);

        Parcelle::create([
            'nom_parcelle' => 'Parcelle 3',
            'localisation_parcelle' => 'Sud',
            'proprietaire_id' => 3,
        ]);
    }
}
