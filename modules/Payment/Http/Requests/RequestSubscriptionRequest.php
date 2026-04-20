<?php
// Payment/Http/Requests/RequestSubscriptionRequest.php

declare(strict_types=1);

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RequestSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'packageId' => ['required', 'integer', 'min:1', 'exists:packages,id'],
            'gatewayId' => ['nullable', 'integer', 'min:1', 'exists:payment_gateways,id'],
            'userNotes' => ['nullable', 'string', 'max:500'],
            'transactionProof' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'packageId.required' => __('payment::validation.packageId.required'),
            'packageId.exists' => __('payment::validation.packageId.exists'),
            'gatewayId.exists' => __('payment::validation.gatewayId.exists'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'packageId' => (int) $this->input('packageId'),
            'gatewayId' => $this->filled('gatewayId') ? (int) $this->input('gatewayId') : null,
        ]);
    }
}
