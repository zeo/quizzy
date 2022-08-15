<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Models;
use App\Policies;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Models\Quiz::class => Policies\QuizPolicy::class,
        Models\Question::class => Policies\QuestionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Password::defaults(function () {
            $rule = Password::min(8);

            return $this->app->environment('production', 'prod')
                ? $rule->mixedCase()->uncompromised()
                : $rule;
        });
    }
}
