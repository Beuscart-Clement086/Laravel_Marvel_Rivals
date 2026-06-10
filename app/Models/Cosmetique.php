<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cosmetique extends Model
{
    protected $table = 'cosmetiques';

    protected $fillable = ['personnage_id', 'type', 'nom', 'rarete', 'image'];

    public function personnage()
    {
        return $this->belongsTo(Personnage::class);
    }
}
