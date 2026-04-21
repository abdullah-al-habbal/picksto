<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ResendVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:email,whatsapp'],
            'purpose' => ['sometimes', 'string', 'in:registration,reset'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'purpose' => $this->input('purpose', 'registration'),
        ]);
    }
}
