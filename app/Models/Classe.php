<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'image'];

    // Relation inverse
    public function personnages()
    {
        return $this->hasMany(Personnage::class);
    }
}

