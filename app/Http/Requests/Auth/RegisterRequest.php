<?php

namespace App\Http\Requests\Auth;

use App\Enums\AuthMethodType;
use App\Models\AuthMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => [
                'required', 'email',
                Rule::unique(AuthMethod::class, 'identifier')
                    ->where('type', AuthMethodType::Email->value),
            ],
            'password' => ['required', 'confirmed', Password::default()],
        ];
    }
}
