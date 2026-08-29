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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->default('MIRANSH LLC');
            $table->string('name_ja')->default('ミランス合同会社');
            $table->string('tagline_en')->default('International Human Resources & Student Support');
            $table->string('tagline_ja')->default('国際人材紹介・留学生紹介');
            $table->string('location_en')->default('Koganei-shi, Tokyo, Japan');
            $table->string('location_ja')->default('東京都小金井市');
            $table->string('phone')->default('042-409-8256');
            $table->text('business_en');
            $table->text('business_ja');
            $table->string('license')->default('13-ユ-319558');
            $table->string('ceo_name')->default('RK Giri');
            $table->string('ceo_role_en')->default('CEO / Representative of MIRANSH LLC');
            $table->string('ceo_role_ja')->default('ミランス合同会社 代表者');
            $table->string('hero_title_en')->default('Connecting Japan');
            $table->string('hero_title_accent_en')->default('Global Talent');
            $table->text('hero_desc_en');
            $table->string('hero_title_ja')->default('日本と世界を');
            $table->string('hero_title_accent_ja')->default('つなぐ会社');
            $table->text('hero_desc_ja');
            $table->string('hero_image')->default('/images/abc.jpeg');
            $table->text('footer_text_en');
            $table->text('footer_text_ja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
