<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table générique des cosmétiques d'un personnage
     * (emotes, sprays, nameplates...). Le champ "type" distingue la catégorie.
     * L'image peut être un nom de fichier local OU une URL externe.
     */
    public function up(): void
    {
        Schema::create('cosmetiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnage_id')->constrained('personnages')->onDelete('cascade');
            $table->string('type'); // emote | spray | nameplate
            $table->string('nom');
            $table->string('rarete')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cosmetiques');
    }
};
