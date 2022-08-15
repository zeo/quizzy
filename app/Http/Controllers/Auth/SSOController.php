<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AuthMethodType;
use App\Http\Controllers\Controller;
use App\Models\AuthMethod;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Socialite\Contracts\User as SocialiteUserInterface;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class SSOController extends Controller
{
    public function redirect(string $method): Response
    {
        abort_if(! $this->isValidSsoMethod($method), 404);

        $redirectUrl = Socialite::driver($method)
            ->redirect()
            ->getTargetUrl();

        return Inertia::location($redirectUrl);
    }

    /**
     * @throws \Throwable
     */
    public function callback(string $method): RedirectResponse
    {
        abort_if(! $this->isValidSsoMethod($method), 404);

        $data = Socialite::driver($method)->user();
        $authMethodType = AuthMethodType::from($method);

        $authMethod = AuthMethod::whereType($authMethodType)
            ->where('identifier', $data->getId())
            ->first();

        if (! $authMethod) {
            $authMethod = DB::transaction(fn () => $this->createAuthMethodWithUser($authMethodType, $data));

            event(new Registered($authMethod->user));
        }

        Auth::login($authMethod->user, remember: true);

        return Redirect::route('index');
    }

    private function isValidSsoMethod(string $ssoMethod): bool
    {
        return in_array($ssoMethod, config('quizzy.sso_methods'));
    }

    private function createAuthMethodWithUser(AuthMethodType $methodType, SocialiteUserInterface $data): AuthMethod
    {
        /** @var User $user */
        $user = tap(User::make([
            'name' => $data->getName(),
            'email' => $data->getEmail(),
        ]), fn (User $user) => $user->markEmailAsVerified());

        /** @var AuthMethod $authMethod */
        $authMethod = $user->authMethod()->create([
            'type' => $methodType,
            'identifier' => $data->getId(),
        ]);

        // Thanks Freek for saving me a database query.
        $authMethod->setRelation('user', $user);

        return $authMethod;
    }
}
