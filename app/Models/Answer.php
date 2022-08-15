<?php

namespace App\Models;

use App\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperAnswer
 */
class Answer extends Model
{
    use HasFactory, HasUuidKey;

    protected $attributes = [
        'order' => 0,
    ];

    protected $fillable = [
        'value', 'is_correct', 'order',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'order' => 'integer',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function sessionAnswers(): HasMany
    {
        return $this->hasMany(QuizSessionAnswer::class);
    }
}
