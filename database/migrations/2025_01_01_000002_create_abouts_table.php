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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('badge_en')->default('About MIRANSH');
            $table->string('badge_ja')->default('MIRANSHについて');
            $table->string('heading_en')->default('Building Bridges Between Japan and the World');
            $table->string('heading_ja')->default('日本と世界をつなぐ架け橋');
            $table->text('subheading_en');
            $table->text('subheading_ja');
            $table->string('title_en')->default('MIRANSH LLC');
            $table->string('title_ja')->default('ミランス合同会社');
            $table->text('desc1_en');
            $table->text('desc1_ja');
            $table->text('desc2_en');
            $table->text('desc2_ja');
            $table->text('quote_en');
            $table->text('quote_ja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
