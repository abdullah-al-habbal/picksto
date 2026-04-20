<?php
// Payment/Http/Requests/UpdateGatewayRequest.php

declare(strict_types=1);

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateGatewayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:100'],
            'type' => ['sometimes', 'string', 'in:stripe,paypal,manual,lemonsqueezy'],
            'description' => ['nullable', 'string', 'max:500'],
            'config' => ['nullable', 'array'],
            'isActive' => ['nullable', 'boolean'],
            'sortOrder' => ['nullable', 'integer', 'min:0', 'max:999'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.in' => __('payment::validation.gateway.type.in'),
        ];
    }
}
