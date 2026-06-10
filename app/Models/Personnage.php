<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnage extends Model
{
    protected $table = 'personnages';
    // Définir l'accessibilité de nos propriétés
    protected $fillable = [
        'photo',
        'nom',
        'classe_id',
        'vie',
        'description',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function costumes()
    {
        return $this->hasMany(Costume::class);
    }

    public function animations()
    {
        return $this->hasMany(Animation::class);
    }

    public function capacites()
    {
        return $this->hasMany(Capacite::class);
    }

    public function cosmetiques()
    {
        return $this->hasMany(Cosmetique::class);
    }

    /**
     * Relation N..N : un personnage peut appartenir à plusieurs groupes.
     */
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'groupe_personnage');
    }

}

