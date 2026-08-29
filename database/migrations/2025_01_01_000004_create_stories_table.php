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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ja');
            $table->string('category_en')->default('Recruitment Story');
            $table->string('category_ja')->default('採用事例');
            $table->text('summary_en');
            $table->text('summary_ja');
            $table->longText('content_en')->nullable();
            $table->longText('content_ja')->nullable();
            $table->string('image')->default('/images/story1.jpg');
            $table->string('published_date')->default('2024.11.15');
            $table->string('author')->default('MIRANSH Editorial');
            $table->boolean('featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
