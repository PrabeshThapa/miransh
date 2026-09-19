<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobBenefit extends Model
{
    protected $fillable = [
        'job_vacancy_id',
        'title_ja',
        'title_en',
        'description_ja',
        'description_en',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id');
    }
}
