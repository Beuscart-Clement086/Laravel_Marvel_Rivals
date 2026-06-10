<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('capacites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnage_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // Ex: "Attaque", "Défense", "Soin", etc.
            $table->integer('degats')->nullable();
            $table->integer('munitions')->nullable();
            $table->integer('cadence')->nullable();
            $table->integer('portée')->nullable();
            $table->integer('rechargement')->nullable();
            $table->string('cible')->nullable(); // Ex: "Ennemi", "Allié", "Soi-même"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacites');
    }
};
