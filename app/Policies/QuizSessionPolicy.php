<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\QuizSession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizSessionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Quiz $quiz
     * @return bool
     */
    public function create(User $user, Quiz $quiz): bool
    {
        if (!$quiz->isPrivate() || $quiz->user_id === $user->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\QuizSession $session
     * @return bool
     */
    public function view(User $user, QuizSession $session): bool
    {
        if ($session->user_id === $user->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can answer a question of the session.
     *
     * @param \App\Models\User $user
     * @param \App\Models\QuizSession $session
     * @return bool|void
     */
    public function answer(User $user, QuizSession $session)
    {
        if ($session->user_id === $user->id) {
            return true;
        }
    }
}
