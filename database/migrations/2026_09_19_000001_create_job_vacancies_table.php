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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('job_code', 50)->unique();
            $table->string('title_ja', 255);
            $table->string('title_en', 255);
            $table->string('employment_type', 50)->default('full_time');
            $table->string('location_ja', 255);
            $table->string('location_en', 255);
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->string('salary_type', 20)->default('monthly');
            $table->text('salary_note_ja')->nullable();
            $table->text('salary_note_en')->nullable();
            $table->text('working_hours_ja')->nullable();
            $table->text('working_hours_en')->nullable();
            $table->text('holidays_ja')->nullable();
            $table->text('holidays_en')->nullable();
            $table->text('description_ja');
            $table->text('description_en');
            $table->string('status', 20)->default('draft');
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('job_responsibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancy_id')->constrained('job_vacancies')->cascadeOnDelete();
            $table->string('title_ja', 255);
            $table->string('title_en', 255);
            $table->text('description_ja')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('job_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancy_id')->constrained('job_vacancies')->cascadeOnDelete();
            $table->string('type', 20)->default('required'); // 'required' or 'preferred'
            $table->text('description_ja');
            $table->text('description_en');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('job_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancy_id')->constrained('job_vacancies')->cascadeOnDelete();
            $table->string('title_ja', 255);
            $table->string('title_en', 255);
            $table->text('description_ja')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_benefits');
        Schema::dropIfExists('job_requirements');
        Schema::dropIfExists('job_responsibilities');
        Schema::dropIfExists('job_vacancies');
    }
};
