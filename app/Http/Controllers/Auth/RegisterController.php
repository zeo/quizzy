<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AuthMethodType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * @throws \Throwable
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = DB::transaction(fn () => $this->createUserWithAuthMethod($request));

        Auth::login($user);
        event(new Registered($user));

        return Redirect::route('index');
    }

    private function createUserWithAuthMethod(RegisterRequest $request): User
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $user->authMethod()->create([
            'type' => AuthMethodType::Email,
            'identifier' => $request->input('email'),
            'secret' => Hash::make($request->input('password')),
        ]);

        return $user;
    }
}
