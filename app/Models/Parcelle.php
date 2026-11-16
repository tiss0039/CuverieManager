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

    //Relation : Une parcelle peut produire plusieurs moûts.

    public function mouts()
    {
        return $this->hasMany(Mout::class);
    }
}
