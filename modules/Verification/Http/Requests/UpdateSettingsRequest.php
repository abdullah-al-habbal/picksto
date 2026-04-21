<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'emailEnabled' => ['required', 'boolean'],
            'whatsappEnabled' => ['required', 'boolean'],
            'smtpHost' => ['nullable', 'string', 'max:255'],
            'smtpPort' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'smtpUsername' => ['nullable', 'string', 'max:255'],
            'smtpPassword' => ['nullable', 'string', 'max:255'],
            'smtpFromAddress' => ['nullable', 'email', 'max:255'],
            'smtpFromName' => ['nullable', 'string', 'max:255'],
            'whatsappApiKey' => ['nullable', 'string', 'max:255'],
            'whatsappPhoneId' => ['nullable', 'string', 'max:255'],
            'codeExpiryMinutes' => ['required', 'integer', 'min:1', 'max:60'],
            'maxAttempts' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'emailEnabled' => $this->boolean('emailEnabled'),
            'whatsappEnabled' => $this->boolean('whatsappEnabled'),
            'codeExpiryMinutes' => (int) $this->input('codeExpiryMinutes'),
            'maxAttempts' => (int) $this->input('maxAttempts'),
        ]);
    }
}
