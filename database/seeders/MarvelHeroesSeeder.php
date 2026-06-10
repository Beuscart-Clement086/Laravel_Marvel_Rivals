<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Personnage;
use App\Models\Classe;
use App\Models\Groupe;

/**
 * Remplit la base avec les héros de Marvel Rivals
 * (données issues du wiki Fandom : nom, rôle, points de vie, groupes).
 *
 * - Réutilise les portraits déjà présents dans public/images/img_personnages/
 * - Idempotent (updateOrCreate sur le nom) : peut être relancé sans doublon
 * - Compatible avec le schéma "classe" (string) OU "classe_id" (clé étrangère)
 */
class MarvelHeroesSeeder extends Seeder
{
    public function run(): void
    {
        // Détecte le schéma de la table personnages
        $useClasseId = Schema::hasColumn('personnages', 'classe_id');

        $classeNames = [
            'V' => 'Avant-Garde', // Vanguard
            'D' => 'Duelliste',   // Duelist
            'S' => 'Stratège',    // Strategist
        ];

        // S'assure que les 3 classes existent (utile pour le schéma classe_id)
        $classeIds = [];
        if ($useClasseId) {
            foreach ($classeNames as $code => $nom) {
                $classeIds[$code] = Classe::firstOrCreate(['nom' => $nom])->id;
            }
        }

        // nom, rôle (V/D/S), fichier image, points de vie, description, groupes
        $heroes = [
            ['Adam Warlock', 'S', 'Adam_Warlock', 250, "Être artificiel à la perfection cosmique, gardien de l'âme.", ['Gardiens de la Galaxie']],
            ['Angela', 'V', 'Angela', 700, "Chasseuse de primes asgardienne élevée dans les royaumes des anges.", ['Gardiens de la Galaxie']],
            ['Black Panther', 'D', 'Black_Panther', 250, "T'Challa, roi du Wakanda, guerrier agile au costume de vibranium.", ['Avengers']],
            ['Black Widow', 'D', 'Black_Widow', 250, "Natasha Romanoff, espionne d'élite et tireuse hors pair.", ['Avengers']],
            ['Blade', 'D', 'Blade', 275, "Chasseur de vampires mi-humain mi-vampire, le Diurne.", ['Defenders']],
            ['Captain America', 'V', 'Captain_America', 675, "Steve Rogers, le Premier Vengeur, protégé par son bouclier en vibranium.", ['Avengers']],
            ['Cloak & Dagger', 'S', 'Cloak_And_Dagger', 250, "Duo lié par la lumière et les ténèbres, soin et offensive.", ['Defenders']],
            ['Daredevil', 'D', 'Daredevil', 250, "Matt Murdock, l'homme sans peur aux sens surhumains.", ['Defenders']],
            ['Docteur Strange', 'V', 'Docteur_Strange', 650, "Sorcier Suprême, maître des arts mystiques et des portails.", ['Avengers', 'Defenders']],
            ['Emma Frost', 'V', 'Emma_Frost', 650, "Reine Blanche télépathe, peau de diamant organique.", ['X-Men']],
            ['Gambit', 'S', 'Gambit', 275, "Remy LeBeau, mutant cajun qui charge les objets d'énergie cinétique.", ['X-Men']],
            ['Groot', 'V', 'Groot', 700, "Arbre extraterrestre capable de faire pousser des murs protecteurs.", ['Gardiens de la Galaxie']],
            ['Hawkeye', 'D', 'Hawkeye', 250, "Clint Barton, archer infaillible aux flèches spéciales.", ['Avengers']],
            ['Hela', 'D', 'Hela', 275, "Déesse asgardienne de la mort, reliée à Hel.", []],
            ['Hulk', 'V', 'Hulk', 700, "Bruce Banner devient le titan vert, plus il est en colère plus il est fort.", ['Avengers']],
            ['Human Torch', 'D', 'La_Torche_Humaine', 250, "Johnny Storm, contrôle le feu et vole en s'enflammant.", ['Quatre Fantastiques']],
            ['Iron Fist', 'D', 'Iron_Fist', 300, "Danny Rand, maître du kung-fu au poing chargé du chi de K'un-Lun.", ['Defenders']],
            ['Iron Man', 'D', 'Iron_Man', 350, "Tony Stark, génie milliardaire dans son armure volante.", ['Avengers']],
            ['Jeff the Land Shark', 'S', 'Jeff_The_Land_Shark', 250, "Adorable requin-terrestre soigneur qui peut engloutir ses ennemis.", []],
            ['Loki', 'S', 'Loki', 250, "Dieu de la malice, illusions et clones trompeurs.", ['Vilains']],
            ['Luna Snow', 'S', 'Luna_Snow', 250, "Idole K-pop et héroïne de glace, soigne en chantant.", []],
            ['Magik', 'D', 'Magik', 275, "Illyana Raspoutine, téléporte via le Limbo et manie l'épée d'âme.", ['X-Men']],
            ['Magneto', 'V', 'Magneto', 650, "Maître du magnétisme, leader mutant et champ de force métallique.", ['X-Men', 'Vilains']],
            ['Mantis', 'S', 'Mantis', 250, "Empathe cosmique capable d'endormir et de doper ses alliés.", ['Gardiens de la Galaxie']],
            ['Mister Fantastic', 'D', 'Mr_Fantastic', 350, "Reed Richards, génie au corps élastique.", ['Quatre Fantastiques']],
            ['Moon Knight', 'D', 'Moon_Knight', 250, "Marc Spector, avatar du dieu lunaire Khonshu.", ['Defenders']],
            ['Namor', 'D', 'Namor', 275, "Prince d'Atlantis, invoque des poissons-tridents et règne sur les mers.", []],
            ['Peni Parker', 'V', 'Peni_Parker', 600, "Pilote du méca SP//dr, pose mines et toiles cybernétiques.", ['Spider-Verse']],
            ['Phoenix', 'D', 'Phoenix', 250, "Jean Grey unie à la Force Phénix cosmique.", ['X-Men']],
            ['Psylocke', 'D', 'Psylocke', 250, "Ninja télépathe maniant des lames psychiques.", ['X-Men']],
            ['Rocket Raccoon', 'S', 'Rocket_Raccoon', 200, "Raton-laveur génie des armes, soigne et relance ses alliés.", ['Gardiens de la Galaxie']],
            ['Rogue', 'S', 'Rogue', 275, "Malicia, mutante qui absorbe pouvoirs et souvenirs au toucher.", ['X-Men']],
            ['Scarlet Witch', 'D', 'Scarlet_Witch', 250, "Wanda Maximoff, magie du chaos et explosions arcaniques.", ['Avengers']],
            ['Spider-Man', 'D', 'Spider-Man', 290, "Peter Parker, le plus agile, se balance et neutralise ses cibles.", ['Spider-Verse']],
            ['Squirrel Girl', 'D', 'Squirell_Girl', 275, "Doreen Green, invincible et entourée d'écureuils.", []],
            ['Star-Lord', 'D', 'Star-Lord', 250, "Peter Quill, hors-la-loi galactique aux blasters jumeaux.", ['Gardiens de la Galaxie']],
            ['Storm', 'D', 'Storm', 250, "Ororo Munroe, déesse mutante du climat, contrôle vent et foudre.", ['X-Men']],
            ['The Punisher', 'D', 'Punisher', 250, "Frank Castle, justicier lourdement armé, mitrailleuse et tourelle.", []],
            ['The Thing', 'V', 'La_Chose', 700, "Ben Grimm, colosse de pierre, force brute et stabilité.", ['Quatre Fantastiques']],
            ['Thor', 'V', 'Thor', 650, "Dieu du tonnerre asgardien et son marteau Mjolnir.", ['Avengers']],
            ['Ultron', 'S', 'Ultron', 250, "Intelligence artificielle volante, soigne par drones.", ['Vilains']],
            ['Venom', 'V', 'Venom', 700, "Symbiote vorace, tentacules et grande résistance.", ['Spider-Verse', 'Vilains']],
            ['Winter Soldier', 'D', 'Winter_Soldier', 275, "Bucky Barnes, bras bionique et crochet ravageur.", ['Avengers']],
            ['Wolverine', 'D', 'Wolverine', 350, "Logan, facteur guérisseur et griffes en adamantium.", ['X-Men']],
            ['Invisible Woman', 'S', 'Invisible_Woman', 275, "Sue Storm, champs de force invisibles, soin et contrôle.", ['Quatre Fantastiques']],
        ];

        foreach ($heroes as $h) {
            [$nom, $role, $img, $vie, $desc, $groupes] = $h;

            $attrs = [
                'photo'       => '../img_personnages/' . $img . '.webp',
                'vie'         => $vie,
                'description' => $desc,
            ];

            if ($useClasseId) {
                $attrs['classe_id'] = $classeIds[$role];
            } else {
                $attrs['classe'] = $classeNames[$role];
            }

            Personnage::updateOrCreate(['nom' => $nom], $attrs);

            // Les groupes (Traits) sont gérés par TraitsSeeder.
        }
    }
}
