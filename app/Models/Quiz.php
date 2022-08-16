<?php

namespace App\Models;

use App\Enums\QuizVisibility;
use App\Traits\HasUuidKey;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory, HasUuidKey;

    protected $fillable = [
        'name', 'visibility'
    ];

    protected $casts = [
        'visibility' => QuizVisibility::class,
    ];

    public function scopePublic(Builder $query)
    {
        return $query->where('visibility', QuizVisibility::Public->value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(QuizSession::class, 'session_id');
    }

    public function isPrivate(): bool
    {
        return $this->visibility === QuizVisibility::Private;
    }
}
