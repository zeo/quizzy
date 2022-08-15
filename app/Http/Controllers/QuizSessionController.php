<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAnswerRequest;
use App\Http\Resources\QuizSessionResource;
use App\Models\Quiz;
use App\Models\QuizSession;
use App\Models\QuizSessionAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class QuizSessionController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Quiz $quiz): RedirectResponse
    {
        $this->authorize('create', [QuizSession::class, $quiz]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        $session = tap($quiz->sessions()->make(), function (Quiz $quiz) use ($user) {
            $quiz->user()->associate($user);
            $quiz->save();
        });

        $this->createAnswerForNextQuestion($session);

        return Redirect::route('quiz-sessions.show', $session);
    }

    public function show(QuizSession $session): Response
    {
        $this->authorize('view', $session);

        return Inertia::render('QuizSessions/Show', [
            'session' => QuizSessionResource::make($session),
        ]);
    }

    public function answer(SubmitAnswerRequest $request, QuizSession $session)
    {
        $this->authorize('answer', $session);
    }

    private function createAnswerForNextQuestion(QuizSession $session)
    {
        $nextQuestion = $session->getNextQuestion();
        if (!$nextQuestion) return;

        tap($session->answers()->make([
            'should_answer_at' => $nextQuestion->time_seconds !== 0
                ? now()->addSeconds($nextQuestion->time_seconds)
                : null,
        ]), function (QuizSessionAnswer $sessionAnswer) use ($nextQuestion) {
            $sessionAnswer->question()->associate($nextQuestion);
            $sessionAnswer->save();
        });
    }
}
