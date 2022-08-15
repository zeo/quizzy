<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/quizzes')
    ->middleware('auth')
    ->name('index');

Route::get('/quizzes', [QuizController::class, 'index'])
    ->middleware('auth')
    ->name('quizzes.index');

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [Auth\LoginController::class, 'index'])
            ->name('login.index');

        Route::post('/login', [Auth\LoginController::class, 'store'])
            ->name('login.store');

        Route::post('/login/sso/{method}', [Auth\SSOController::class, 'redirect'])
            ->name('login.sso.redirect');

        Route::get('/login/sso/{method}', [Auth\SSOController::class, 'callback'])
            ->name('login.sso.callback');

        Route::get('/register', [Auth\RegisterController::class, 'index'])
            ->name('register.index');

        Route::post('/register', [Auth\RegisterController::class, 'store'])
            ->name('register.store');
    });

    Route::post('/logout', Auth\LogoutController::class)
        ->middleware('auth')
        ->name('auth.logout');
});

Route::prefix('/dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    // Quiz Routes
    Route::get('/quizzes', [Dashboard\QuizController::class, 'index'])
        ->name('quizzes.index');

    Route::get('/quizzes/create', [Dashboard\QuizController::class, 'create'])
        ->name('quizzes.create');

    Route::post('/quizzes', [Dashboard\QuizController::class, 'store'])
        ->name('quizzes.store');

    Route::get('/quizzes/{quiz}', [Dashboard\QuizController::class, 'edit'])
        ->name('quizzes.edit');

    Route::delete('/quizzes/{quiz}', [Dashboard\QuizController::class, 'destroy'])
        ->name('quizzes.destroy');

    // Quiz Question Routes
    Route::post('/quizzes/{quiz}/questions', [Dashboard\QuestionController::class, 'store'])
        ->name('quizzes.questions.store');

    Route::patch('/quizzes/{quiz}/questions/{question}', [Dashboard\QuestionController::class, 'update'])
        ->name('quizzes.questions.update');

    Route::delete('/quizzes/{quiz}/questions/{question}', [Dashboard\QuestionController::class, 'destroy'])
        ->name('quizzes.questions.destroy');
});
