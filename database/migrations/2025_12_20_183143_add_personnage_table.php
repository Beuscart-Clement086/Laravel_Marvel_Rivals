<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personnages', function (Blueprint $table) {
            // Supprime les colonnes de l'ancienne structure
            $table->dropColumn(['histoire', 'pouvoirs', 'faiblesses', 'cosmetiques', 'description_courte', 'description', 'image']);

            // Ajoute les nouvelles colonnes
            $table->string('photo')->default('aucune');
            $table->string('classe');
            $table->decimal('vie');
        });
    }

    public function down(): void
    {
        Schema::table('personnages', function (Blueprint $table) {
            $table->dropColumn(['photo', 'classe', 'vie']);

            $table->text('histoire');
            $table->string('pouvoirs');
            $table->text('description');
            $table->text('faiblesses');
            $table->text('cosmetiques');
            $table->text('description_courte', 255);
            $table->string('image')->nullable();
        });
    }
};