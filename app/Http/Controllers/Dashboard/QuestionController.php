<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function store(Request $request, Quiz $quiz): RedirectResponse
    {
        $this->authorize('create', [Question::class, $quiz]);

        $quiz->questions()->create([
            'name' => Question::DEFAULT_NAME,
        ]);

        return Redirect::route('dashboard.quizzes.edit', $quiz);
    }

    public function update(UpdateQuestionRequest $request, Quiz $quiz, Question $question): RedirectResponse
    {
        $this->authorize('update', [$question, $quiz]);

        $question->update([
            'name' => $request->input('name'),
            'time_seconds' => $request->input('time_seconds'),
        ]);

        // TODO: find a better way to do this.
        $question->answers()->delete();
        $question->answers()->createMany($request->input('answers'));

        return Redirect::route('dashboard.quizzes.edit', $quiz);
    }

    public function destroy(Quiz $quiz, Question $question): RedirectResponse
    {
        $this->authorize('delete', [$question, $quiz]);

        $question->delete();

        return Redirect::route('dashboard.quizzes.edit', $quiz);
    }
}
