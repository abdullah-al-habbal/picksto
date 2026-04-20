<?php
// Payment/Http/Requests/StoreGatewayRequest.php

declare(strict_types=1);

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreGatewayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'in:stripe,paypal,manual,lemonsqueezy'],
            'description' => ['nullable', 'string', 'max:500'],
            'config' => ['nullable', 'array'],
            'isActive' => ['nullable', 'boolean'],
            'sortOrder' => ['nullable', 'integer', 'min:0', 'max:999'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('payment::validation.gateway.name.required'),
            'type.required' => __('payment::validation.gateway.type.required'),
            'type.in' => __('payment::validation.gateway.type.in'),
        ];
    }
}
