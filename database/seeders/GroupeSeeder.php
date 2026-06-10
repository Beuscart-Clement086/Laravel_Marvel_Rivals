<?php

namespace Database\Seeders;

use App\Models\Groupe;
use Illuminate\Database\Seeder;

/**
 * Groupes = "Traits" officiels de Marvel Rivals
 * (https://marvelrivals.fandom.com/wiki/Traits).
 * Seuls ces groupes existent ; les autres sont supprimés.
 */
class GroupeSeeder extends Seeder
{
    public function run(): void
    {
        $groupes = [
            "Agents de l'Atlas",
            'Avengers',
            'Quatre Fantastiques',
            "Dieux d'Asgard",
            'Gardiens de la Galaxie',
            'Arme Immortelle',
            'Marvel Knights',
            'Midnight Sons',
            'Mutants',
            'Vilains',
            'Web Warriors',
            'X-Men',
        ];

        // Supprime les groupes qui ne sont pas des traits officiels
        // (la suppression retire aussi les liaisons via la clé étrangère en cascade).
        Groupe::whereNotIn('nom', $groupes)->delete();

        // Crée les 12 traits s'ils n'existent pas
        foreach ($groupes as $nom) {
            Groupe::firstOrCreate(['nom' => $nom]);
        }
    }
}
