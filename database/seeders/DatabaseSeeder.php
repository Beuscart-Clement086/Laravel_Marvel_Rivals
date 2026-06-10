<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders sûrs et idempotents (ne détruisent pas les données existantes).
        // PersonnageSeeder n'est volontairement PAS appelé ici : il fait un
        // truncate() et utilise d'anciennes colonnes supprimées.
        $this->call( [
            AdminSeeder::class,
            GroupeSeeder::class,
            MarvelHeroesSeeder::class,
            TraitsSeeder::class,
            CosmeticsSeeder::class,
        ]);
    }
}
