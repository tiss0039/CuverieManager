<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    use HasFactory;

    protected $fillable = ['nom_proprietaire'];

    
    //Relation : Un propriétaire possède plusieurs moûts.
     
    public function mouts()
    {
        return $this->hasMany(Mout::class);
    }

    
    //Relation : Un propriétaire possède plusieurs parcelles.
    
    public function parcelles()
    {
        return $this->hasMany(Parcelle::class);
    }
}
