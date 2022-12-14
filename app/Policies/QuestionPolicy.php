<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create an instance of the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Quiz $quiz
     * @return bool|null
     */
    public function create(User $user, Quiz $quiz): ?bool
    {
        if ($quiz->user_id === $user->id) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Question $question
     * @param \App\Models\Quiz $quiz
     * @return bool|null
     */
    public function update(User $user, Question $question, Quiz $quiz): ?bool
    {
        if ($quiz->user_id === $user->id) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Question $question
     * @param \App\Models\Quiz $quiz
     * @return bool|null
     */
    public function delete(User $user, Question $question, Quiz $quiz): ?bool
    {
        if ($quiz->user_id === $user->id) {
            return true;
        }

        return null;
    }
}
