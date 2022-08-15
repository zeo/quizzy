<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Quiz $quiz
     * @return bool
     */
    public function update(User $user, Quiz $quiz): bool
    {
        if ($quiz->user_id === $user->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quiz  $quiz
     * @return bool
     */
    public function delete(User $user, Quiz $quiz): bool
    {
        if ($quiz->user_id === $user->id) {
            return true;
        }
    }
}
