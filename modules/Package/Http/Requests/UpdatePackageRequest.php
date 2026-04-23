<?php

// modules/Package/Http/Requests/UpdatePackageRequest.php

declare(strict_types=1);

namespace Modules\Package\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdatePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.ar' => ['sometimes', 'string', 'max:100'],
            'name.en' => ['nullable', 'string', 'max:100'],
            'description.ar' => ['nullable', 'string', 'max:500'],
            'description.en' => ['nullable', 'string', 'max:500'],
            'price' => ['sometimes', 'numeric', 'min:0', 'max:999999.99'],
            'currency' => ['sometimes', 'string', Rule::in(['SAR', 'USD', 'EUR'])],
            'daily_limit' => ['sometimes', 'integer', 'min:1', 'max:1000'],
            'monthly_limit' => ['sometimes', 'integer', 'min:1', 'max:10000'],
            'allowed_sites' => ['sometimes', 'array'],
            'allowed_sites.*' => ['string', 'in:Freepik,Flaticon,Envato Elements,MotionArray,Shutterstock,AdobeStock,Artlist,Pikbest,Placeit,All'],
            'duration_days' => ['sometimes', 'integer', 'min:1', 'max:365'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.ar.sometimes' => __('package::validation.name.ar.sometimes'),
            'price.numeric' => __('package::validation.price.numeric'),
            'currency.in' => __('package::validation.currency.in'),
            'allowed_sites.array' => __('package::validation.allowed_sites.array'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'price' => $this->filled('price') ? (float) $this->input('price') : null,
            'daily_limit' => $this->filled('daily_limit') ? (int) $this->input('daily_limit') : null,
            'monthly_limit' => $this->filled('monthly_limit') ? (int) $this->input('monthly_limit') : null,
            'duration_days' => $this->filled('duration_days') ? (int) $this->input('duration_days') : null,
        ]);
    }
}
