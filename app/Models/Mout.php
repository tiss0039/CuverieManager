<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mout extends Model
{
    use HasFactory;

    protected $fillable = ['volume', 'type', 'cuve_id', 'proprietaire_id', 'parcelle_id'];

    
    //Relation : Chaque moût appartient à une cuve.
     
    public function cuve()
    {
        return $this->belongsTo(Cuve::class);
    }

    
    //Relation : Chaque moût appartient à un propriétaire.
    
    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }

    //Relation : Un moût peut provenir d'une parcelle (facultatif).

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}
