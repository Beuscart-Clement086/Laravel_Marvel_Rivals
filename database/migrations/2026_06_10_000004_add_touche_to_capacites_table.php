<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute la touche (raccourci clavier/souris) à une capacité.
     */
    public function up(): void
    {
        Schema::table('capacites', function (Blueprint $table) {
            $table->string('touche')->nullable()->after('nom');
        });
    }

    public function down(): void
    {
        Schema::table('capacites', function (Blueprint $table) {
            $table->dropColumn('touche');
        });
    }
};
