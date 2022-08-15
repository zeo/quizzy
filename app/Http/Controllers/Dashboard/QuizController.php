<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateQuizRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    public function index(Request $request): Response
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $quizzes = $user->quizzes()
            ->withCount('questions')
            ->get();

        return Inertia::render('Dashboard/Quizzes/Index', [
            'quizzes' => QuizResource::collection($quizzes),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Dashboard/Quizzes/Create');
    }

    public function store(CreateQuizRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        /** @var \App\Models\Quiz $quiz */
        $quiz = $user->quizzes()->create([
            'name' => $request->input('name'),
            'visibility' => $request->getQuizVisibility(),
        ]);

        return Redirect::route('dashboard.quizzes.edit', $quiz);
    }

    public function edit(Quiz $quiz): Response
    {
        $this->authorize('update', $quiz);

        $quiz->loadMissing('questions', 'questions.answers');

        return Inertia::render('Dashboard/Quizzes/Edit', [
            'quiz' => QuizResource::make($quiz),
        ]);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);
    }

    public function destroy(Quiz $quiz): RedirectResponse
    {
        $this->authorize('delete', $quiz);

        $quiz->delete();

        return Redirect::route('dashboard.quizzes.index');
    }
}
