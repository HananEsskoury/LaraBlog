<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('vues')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('categorie_id')->nullable()->constrained('categories')->nullOnDelete(); // ✅ correct
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};