<?php

// modules/LemonSqueezy/Http/Requests/CreateCheckoutRequest.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'variantId' => ['required', 'integer', 'min:1'],
            'redirectUrl' => ['nullable', 'url', 'max:2048'],
            'customData' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'variantId.required' => __('lemonsqueezy::validation.variantId.required'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'variantId' => (int) $this->input('variantId'),
        ]);
    }
}
