<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proprietaire;

class ProprietaireSeeder extends Seeder
{
    public function run(): void
    {
        Proprietaire::create(['nom_proprietaire' => 'Château Margaux']);
        Proprietaire::create(['nom_proprietaire' => 'Domaine de la Romanée-Conti']);
    }
}
