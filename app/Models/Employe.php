<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'role_id'];

    
    //Relation : Un employé appartient à un rôle.
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    
    //Relation : Un employé peut effectuer plusieurs actions historiques.
    
    public function historiques()
    {
        return $this->hasMany(Historique::class);
    }
}
