<?php

// modules/Auth/Http/Requests/ResetPasswordRequest.php

declare(strict_types=1);

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('auth::validation.token.required'),
            'email.required' => __('auth::validation.email.required'),
            'email.email' => __('auth::validation.email.email'),
            'password.required' => __('auth::validation.password.required'),
            'password.confirmed' => __('auth::validation.password.confirmed'),
            'password.min' => __('auth::validation.password.min'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => trim(strtolower($this->email)),
        ]);
    }
}
