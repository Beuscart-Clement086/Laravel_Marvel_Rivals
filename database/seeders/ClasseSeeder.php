<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personnage;
use App\Models\Classe;


class ClasseSeeder extends Seeder
{
    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes=[
            ['nom' => 'Avant-Garde', 'image' => '/vanguard.webp'],
            ['nom' => 'Duelliste', 'image' => '/duelist.webp'],
            ['nom' => 'Stratège', 'image' => '/strategist.webp'],

        ];


        foreach ($classes as $data) {
            $personnage = Personnage::where('nom', $data['nom'])->first();
            if ($personnage) {
                $data['image'] = $personnage->image;
                Classe::updateOrCreate(['nom' => $data['nom']], ['image' => $data['image']]);
            };
                
        }
    }
}
