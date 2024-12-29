<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = ['type_action', 'date_action', 'employe_id'];

    
    //Relation : Une action appartient à un employé.
    
    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
