<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Personnage;
use App\Models\Classe;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PersonnageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Personnage::truncate();
        Schema::enableForeignKeyConstraints();
        $classe = Classe::where('nom', 'Avant-Garde')->first();

        Personnage::create([
            'nom' => 'Docteur Strange',
            'image' => '/Doctor_Strange/Doctor-strange.webp',
            'histoire' => 'Bonjour',
            'pouvoirs' => 'dodo',
            'description' => 'Dr strange fait de la magie',
            'faiblesses' => 'va savoir',
            'cosmetiques' => 'Cape',
            'description_courte' => 'magie',
            'classe_id' => $classe->id
        ]);
    }
}
