<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrInsert : évite l'erreur de doublon si le seeder est relancé.
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@marvelrivals.fr'],
            [
                'name'       => 'admin',
                'password'   => Hash::make('MarvelRivalsAdmin1*'),
                'is_admin'   => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}