<?php

namespace App\Models;

use App\Traits\HasUuidKey;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizSession extends Model
{
    use HasFactory, HasUuidKey;

    protected $fillable = [

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuizSessionAnswer::class);
    }

    /**
     * The current question is the first question of the quiz sorted by the order
     * where the sessionAnswer exists but the user has not answered the question yet.
     *
     * @return \App\Models\Question
     */
    public function getCurrentQuestion(): Question
    {
        /** @var \App\Models\Question $question */
        $question = $this->quiz->questions()
            ->whereHas('answers') // Skip questions that don't have answers
            ->whereHas('sessionAnswers', function (Builder $query) {
                $query->where('session_id', $this->id)
                    ->whereNull('answer_id');
            })
            ->orderBy('order')
            ->first();

        return $question;
    }

    /**
     * The next question is the first question of the quiz sorted by the order
     * where the sessionAnswer doesn't exist.
     *
     * @return \App\Models\Question|null
     */
    public function getNextQuestion(): ?Question
    {
        /** @var ?\App\Models\Question $question */
        $question = $this->quiz->questions()
            ->whereHas('answers') // Skip questions that don't have answers
            ->whereDoesntHave('sessionAnswers', function (Builder $query) {
                $query->where('session_id', $this->id)
                    ->whereNotNull('answer_id');
            })
            ->orderBy('order')
            ->first();

        return $question;
    }
}
