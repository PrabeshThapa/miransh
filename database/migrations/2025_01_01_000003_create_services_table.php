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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('number_label')->default('01');
            $table->string('title_en');
            $table->string('title_ja');
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_ja')->nullable();
            $table->string('icon')->default('users');
            $table->string('image')->nullable();
            $table->text('desc_en');
            $table->text('desc_ja');
            $table->longText('full_content_en')->nullable();
            $table->longText('full_content_ja')->nullable();
            $table->json('items_en');
            $table->json('items_ja');
            $table->json('workflow_steps_en')->nullable();
            $table->json('workflow_steps_ja')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
