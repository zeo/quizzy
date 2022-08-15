<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AuthMethodType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AuthMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $authMethod = AuthMethod::whereType(AuthMethodType::Email)
            ->where('identifier', $request->input('email'))
            ->first();

        if (! $authMethod || ! Hash::check($request->input('password'), $authMethod->secret)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Auth::login($authMethod->user);

        return Redirect::route('index');
    }
}
