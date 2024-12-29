<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    use HasFactory;

    protected $fillable = ['nom_parcelle', 'localisation_parcelle', 'proprietaire_id'];

    
    //Relation : Une parcelle appartient à un propriétaire.
    
    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }
}
