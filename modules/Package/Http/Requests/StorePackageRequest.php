<?php
// modules/Package/Http/Requests/StorePackageRequest.php

declare(strict_types=1);

namespace Modules\Package\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ar' => ['required', 'string', 'max:100'],
            'name_en' => ['nullable', 'string', 'max:100'],
            'description_ar' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string', 'max:500'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'currency' => ['required', 'string', 'in:SAR,USD,EUR'],
            'daily_limit' => ['required', 'integer', 'min:1', 'max:1000'],
            'monthly_limit' => ['required', 'integer', 'min:1', 'max:10000'],
            'allowed_sites' => ['required', 'array'],
            'allowed_sites.*' => ['string', 'in:Freepik,Flaticon,Envato Elements,MotionArray,Shutterstock,AdobeStock,Artlist,Pikbest,Placeit,All'],
            'duration_days' => ['required', 'integer', 'min:1', 'max:365'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => __('package::validation.name_ar.required'),
            'price.required' => __('package::validation.price.required'),
            'price.numeric' => __('package::validation.price.numeric'),
            'currency.in' => __('package::validation.currency.in'),
            'allowed_sites.required' => __('package::validation.allowed_sites.required'),
            'duration_days.required' => __('package::validation.duration_days.required'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'price' => (float) $this->input('price'),
            'daily_limit' => (int) $this->input('daily_limit'),
            'monthly_limit' => (int) $this->input('monthly_limit'),
            'duration_days' => (int) $this->input('duration_days'),
        ]);
    }
}
