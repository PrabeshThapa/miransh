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
            $table->string('name_ja')->default('MIRANSH合同会社（ミランス合同会社）');
            $table->string('corporate_number')->default('5012403006691');
            $table->string('license')->default('有料職業紹介事業許可：13-ユ-319558');
            $table->string('corporate_form_en')->default('Limited Liability Company (LLC)');
            $table->string('corporate_form_ja')->default('合同会社');
            $table->string('established_en')->default('August 1, 2024');
            $table->string('established_ja')->default('2024年8月1日（法人番号指定日）');
            $table->string('tagline_en')->default('Bridging Japanese Enterprises and Global Talent with Trust');
            $table->string('tagline_ja')->default('日本企業と海外人材をつなぐ、信頼の架け橋');
            $table->string('location_en')->default('Koganei-shi, Tokyo, Japan');
            $table->string('location_ja')->default('東京都小金井市');
            $table->text('address_en')->nullable();
            $table->text('address_ja')->nullable();
            $table->string('phone')->default('042-409-8256');
            $table->string('email')->default('info@miransh.jp');
            $table->text('business_en');
            $table->text('business_ja');
            $table->string('ceo_name')->default('ギリ ラム クリシュナ (Giri Ram Krishna)');
            $table->string('ceo_name_ja')->default('ギリ ラム クリシュナ');
            $table->string('ceo_name_en')->default('Giri Ram Krishna');
            $table->string('ceo_role_en')->default('Representative Member / CEO');
            $table->string('ceo_role_ja')->default('代表社員 (CEO)');
            $table->string('ceo_image')->default('/images/ceo_portrait.jpg');
            $table->text('ceo_message_en')->nullable();
            $table->text('ceo_message_ja')->nullable();
            $table->string('hero_title_en')->default('Bridging Japanese Enterprises and');
            $table->string('hero_title_accent_en')->default('Global Talent with Trust');
            $table->text('hero_desc_en');
            $table->string('hero_title_ja')->default('日本企業と海外人材をつなぐ、');
            $table->string('hero_title_accent_ja')->default('信頼の架け橋。');
            $table->text('hero_desc_ja');
            $table->string('hero_image')->default('/images/hero_banner.jpg');
            $table->string('strengths_tagline_en')->default('Beyond Recruitment — Continuous, High-Touch Support');
            $table->string('strengths_tagline_ja')->default('人材紹介だけで終わらない、手厚い継続サポート');
            $table->text('strengths_desc_en')->nullable();
            $table->text('strengths_desc_ja')->nullable();
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
