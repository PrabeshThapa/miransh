<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobVacancy extends Model
{
    protected $fillable = [
        'job_code',
        'title_ja',
        'title_en',
        'employment_type',
        'location_ja',
        'location_en',
        'salary_min',
        'salary_max',
        'salary_type',
        'salary_note_ja',
        'salary_note_en',
        'working_hours_ja',
        'working_hours_en',
        'holidays_ja',
        'holidays_en',
        'description_ja',
        'description_en',
        'status',
        'sort_order',
        'published_at',
        'closed_at',
    ];

    protected $casts = [
        'salary_min' => 'integer',
        'salary_max' => 'integer',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function responsibilities(): HasMany
    {
        return $this->hasMany(JobResponsibility::class)->orderBy('sort_order', 'asc');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class)->orderBy('sort_order', 'asc');
    }

    public function requiredRequirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class)->where('type', 'required')->orderBy('sort_order', 'asc');
    }

    public function preferredRequirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class)->where('type', 'preferred')->orderBy('sort_order', 'asc');
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(JobBenefit::class)->orderBy('sort_order', 'asc');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
