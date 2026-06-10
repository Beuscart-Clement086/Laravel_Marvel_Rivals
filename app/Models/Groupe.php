<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table = 'groupes';

    protected $fillable = ['nom', 'image'];

    /**
     * Relation N..N : un groupe contient plusieurs personnages.
     */
    public function personnages()
    {
        return $this->belongsToMany(Personnage::class, 'groupe_personnage');
    }
}
