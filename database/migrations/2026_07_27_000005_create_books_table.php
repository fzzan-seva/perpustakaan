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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('title');
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->foreignId('author_id')->constrained('authors')->restrictOnDelete();
            $table->foreignId('publisher_id')->constrained('publishers')->restrictOnDelete();
            $table->foreignId('rack_id')->constrained('racks')->restrictOnDelete();
            $table->integer('stock')->default(1);
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
