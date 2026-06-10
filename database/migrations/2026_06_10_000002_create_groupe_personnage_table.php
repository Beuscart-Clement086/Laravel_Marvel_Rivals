<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table pivot pour la relation N..N entre personnages et groupes :
     * un personnage peut appartenir à plusieurs groupes,
     * un groupe peut contenir plusieurs personnages.
     */
    public function up(): void
    {
        Schema::create('groupe_personnage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnage_id')->constrained('personnages')->onDelete('cascade');
            $table->foreignId('groupe_id')->constrained('groupes')->onDelete('cascade');
            $table->timestamps();

            // Empêche d'ajouter deux fois le même personnage dans le même groupe
            $table->unique(['personnage_id', 'groupe_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groupe_personnage');
    }
};
