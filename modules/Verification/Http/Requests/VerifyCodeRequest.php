<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class VerifyCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'size:6'],
            'type' => ['required', 'string', 'in:email,whatsapp'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('verification::validation.code.required'),
            'code.size' => __('verification::validation.code.size'),
            'type.required' => __('verification::validation.type.required'),
        ];
    }
}
