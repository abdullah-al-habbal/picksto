<?php
// modules/Auth/Http/Requests/RegisterRequest.php

declare(strict_types=1);

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullName' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers(),
            ],
            'phone' => ['nullable', 'string', 'regex:/^\+?\d{7,20}$/', 'max:20'],
            'profession' => ['nullable', 'string', 'max:100'],
            'companySize' => ['nullable', 'string', 'max:50'],
            'referredBy' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'fullName.required' => __('auth::validation.fullName.required'),
            'fullName.min' => __('auth::validation.fullName.min'),
            'email.required' => __('auth::validation.email.required'),
            'email.email' => __('auth::validation.email.email'),
            'email.unique' => __('auth::validation.email.unique'),
            'password.required' => __('auth::validation.password.required'),
            'password.confirmed' => __('auth::validation.password.confirmed'),
            'password.min' => __('auth::validation.password.min'),
            'phone.regex' => __('auth::validation.phone.regex'),
            'referredBy.exists' => __('auth::validation.referredBy.exists'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => trim(strtolower($this->email)),
            'fullName' => trim($this->fullName),
            'phone' => $this->phone ? trim($this->phone) : null,
        ]);
    }
}
