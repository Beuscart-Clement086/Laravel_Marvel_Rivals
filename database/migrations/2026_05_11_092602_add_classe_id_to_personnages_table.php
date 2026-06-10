<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('personnages', function (Blueprint $table) {
        $table->dropColumn('classe'); // ← supprime l'ancienne colonne string
        $table->foreignId('classe_id')->nullable()->constrained('classes')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('personnages', function (Blueprint $table) {
        $table->dropForeign(['classe_id']);
        $table->dropColumn('classe_id');
        $table->string('classe')->nullable(); // ← restaure l'ancienne
    });
}
};