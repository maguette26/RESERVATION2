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
        Schema::table('reservations', function (Blueprint $table) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->dropForeign(['event_id']); // Supprimer la clé étrangère
                $table->dropColumn('event_id');    // Supprimer la colonne
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { Schema::table('reservations', function (Blueprint $table) {
        $table->foreignId('event_id')->constrained(); // Ajouter à nouveau la colonne et la clé étrangère
    });
    }
};
