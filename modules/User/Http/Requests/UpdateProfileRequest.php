<?php
// modules/User/Http/Requests/UpdateProfileRequest.php

declare(strict_types=1);

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'regex:/^\+?\d{7,20}$/',
                'max:20',
            ],
            'profession' => ['nullable', 'string', 'max:100'],
            'companySize' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('user::validation.name.required'),
            'name.min' => __('user::validation.name.min'),
            'email.email' => __('user::validation.email.email'),
            'email.unique' => __('user::validation.email.unique'),
            'phone.regex' => __('user::validation.phone.regex'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => trim(strtolower($this->email)),
            'name' => trim($this->name),
        ]);
    }
}
