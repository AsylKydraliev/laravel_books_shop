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
            $table->string('title');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')
                ->references('id')->on('authors')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('image');
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