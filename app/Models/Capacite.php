<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacite extends Model
{
    protected $fillable = [
        'nom',
        'touche',
        'description',
        'type',
        'degats',
        'munitions',
        'cadence',
        'portée',
        'rechargement',
        'cible',
        'personnage_id',
        'image'
    ];

    public function personnage()
    {
        return $this->belongsTo(Personnage::class);
    }
}
