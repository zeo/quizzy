<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\QuizVisibility;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuizRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'is_private' => ['required', 'boolean'],
        ];
    }

    public function getQuizVisibility(): QuizVisibility
    {
        return $this->boolean('is_private')
            ? QuizVisibility::Private
            : QuizVisibility::Public;
    }
}
