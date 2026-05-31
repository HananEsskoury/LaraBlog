<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Supprime l'ancienne contrainte
            $table->dropForeign('posts_reviewed_by_foreign');
            
            // Recrée avec cascade
            $table->foreign('reviewed_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_reviewed_by_foreign');
            $table->foreign('reviewed_by')
                  ->references('id')
                  ->on('users');
        });
    }
};