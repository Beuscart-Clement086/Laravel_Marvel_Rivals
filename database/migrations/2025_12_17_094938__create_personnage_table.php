<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personnages', function (Blueprint $table){
            $table->id();
            $table->string('nom')->unique();
            $table->text('histoire');
            $table->string('pouvoirs');
            $table->text('description');
            $table->text('faiblesses');
            $table->text('cosmetiques');
            $table->text('description_courte', 255);
            $table->string('image')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
