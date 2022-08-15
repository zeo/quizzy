<?php

namespace App\Models;

use App\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperQuestion
 */
class Question extends Model
{
    use HasFactory, HasUuidKey;

    public const DEFAULT_NAME = 'Unnamed question';

    protected $attributes = [
        'time_seconds' => 0,
    ];

    protected $fillable = [
        'name', 'time_seconds','order',
    ];

    protected $casts = [
        'time_seconds' => 'integer',
        'order' => 'integer',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function sessionAnswers(): HasMany
    {
        return $this->hasMany(QuizSessionAnswer::class);
    }
}
