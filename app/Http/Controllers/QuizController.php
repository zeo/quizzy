<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\CreateQuizRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    public function index(): Response
    {
        $quizzes = Quiz::public()
            ->withCount('questions')
            ->get();

        return Inertia::render('Quizzes/Index', [
            'quizzes' => QuizResource::collection($quizzes),
        ]);
    }

    public function store(CreateQuizRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $user->quizzes()->create($request->validated());
    }
}
