<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costume extends Model
{
    protected $fillable = ['nom', 'rarete', 'image', 'video', 'personnage_id'];

public function personnage()
{
    return $this->belongsTo(Personnage::class);
}
}


