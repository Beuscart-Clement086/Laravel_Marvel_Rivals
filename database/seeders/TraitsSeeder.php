<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Groupe;
use App\Models\Personnage;

/**
 * Associe chaque personnage à ses "Traits" (groupes) selon le wiki :
 * https://marvelrivals.fandom.com/wiki/Traits
 *
 * Doit s'exécuter APRÈS MarvelHeroesSeeder (les personnages doivent exister).
 * Utilise sync() : remplace exactement les groupes de chaque personnage.
 */
class TraitsSeeder extends Seeder
{
    public function run(): void
    {
        // trait => liste des personnages (noms tels qu'enregistrés dans la BD)
        $traits = [
            "Agents de l'Atlas"      => ['Iron Fist', 'Luna Snow'],
            'Avengers'               => ['Black Panther', 'Black Widow', 'Blade', 'Hulk', 'Captain America', 'Docteur Strange', 'Hawkeye', 'Iron Man', 'Jeff the Land Shark', 'Namor', 'Scarlet Witch', 'Squirrel Girl', 'Thor', 'Winter Soldier'],
            'Quatre Fantastiques'    => ['Human Torch', 'Invisible Woman', 'Mister Fantastic', 'The Thing'],
            "Dieux d'Asgard"         => ['Angela', 'Hela', 'Loki', 'Thor'],
            'Gardiens de la Galaxie' => ['Adam Warlock', 'Groot', 'Mantis', 'Rocket Raccoon', 'Star-Lord', 'Venom'],
            'Arme Immortelle'        => ['Iron Fist'],
            'Marvel Knights'         => ['Blade', 'Cloak & Dagger', 'Daredevil', 'Moon Knight', 'The Punisher'],
            'Midnight Sons'          => ['Blade', 'Docteur Strange', 'Magik', 'Moon Knight'],
            'Mutants'                => ['Emma Frost', 'Gambit', 'Magik', 'Magneto', 'Namor', 'Phoenix', 'Psylocke', 'Rogue', 'Storm', 'Wolverine'],
            'Vilains'                => ['Emma Frost', 'Hela', 'Magneto', 'Namor', 'Phoenix', 'Ultron', 'Venom'],
            'Web Warriors'           => ['Peni Parker', 'Spider-Man', 'Venom'],
            'X-Men'                  => ['Emma Frost', 'Gambit', 'Magik', 'Magneto', 'Phoenix', 'Rogue', 'Psylocke', 'Storm', 'Wolverine'],
        ];

        // Inverse la table : personnage => [ids de groupes]
        $assignations = [];
        foreach ($traits as $groupeNom => $persos) {
            $groupe = Groupe::firstOrCreate(['nom' => $groupeNom]);
            foreach ($persos as $nom) {
                $assignations[$nom][] = $groupe->id;
            }
        }

        // Synchronise les groupes de chaque personnage
        foreach ($assignations as $nom => $groupeIds) {
            $personnage = Personnage::where('nom', $nom)->first();
            if ($personnage) {
                $personnage->groupes()->sync($groupeIds);
            }
        }
    }
}
