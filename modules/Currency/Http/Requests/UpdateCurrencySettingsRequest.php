<?php
// Currency/Http/Requests/UpdateCurrencySettingsRequest.php

declare(strict_types=1);

namespace Modules\Currency\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateCurrencySettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'size:3'],
            'symbol' => ['required', 'string', 'max:10'],
            'name' => ['required', 'string', 'max:100'],
            'decimalPlaces' => ['required', 'integer', 'min:0', 'max:5'],
            'decimalSeparator' => ['required', 'string', 'size:1'],
            'thousandsSeparator' => ['required', 'string', 'size:1'],
            'symbolPosition' => ['required', 'boolean'],
            'spaceBetween' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.size' => __('currency::validation.code.size'),
            'decimalSeparator.size' => __('currency::validation.decimalSeparator.size'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'decimalPlaces' => (int) $this->input('decimalPlaces'),
            'symbolPosition' => $this->boolean('symbolPosition'),
            'spaceBetween' => $this->boolean('spaceBetween'),
        ]);
    }
}
