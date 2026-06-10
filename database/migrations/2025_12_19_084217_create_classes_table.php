<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('classe_id')->nullable(); // Nullable pour les racines
            $table->timestamps();
        });

        // Ajoute la contrainte après la création de la table
        Schema::table('classes', function (Blueprint $table) {
            $table->foreign('classe_id')
                ->references('id')
                ->on('classes') // <-- Ici, c'est bien "classes" (pluriel)
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};