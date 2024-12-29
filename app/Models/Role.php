<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nom_role'];

    
    //Relation : Un rôle peut être attribué à plusieurs employés.
     
    public function employes()
    {
        return $this->hasMany(Employe::class);
    }
}
