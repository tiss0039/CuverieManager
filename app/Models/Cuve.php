<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuve extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'volume_maximum'];

    // Relation : Une cuve contient plusieurs moûts
    public function mouts()
    {
        return $this->hasMany(Mout::class);
    }
}
