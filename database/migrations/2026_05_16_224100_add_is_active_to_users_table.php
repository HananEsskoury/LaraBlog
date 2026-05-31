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
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne is_active après la colonne usertype
            $table->boolean('is_active')->default(true)->after('usertype');
            
            // Optionnel : ajouter un index pour améliorer les performances des requêtes
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'is_active')) {
            $table->dropColumn('is_active');
        }
    });
}
};