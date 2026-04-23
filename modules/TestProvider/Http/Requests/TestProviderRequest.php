<?php

declare(strict_types=1);

namespace Modules\TestProvider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class TestProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider' => ['required', 'array'],
            'provider.name' => ['required', 'string', 'max:100'],
            'provider.email' => ['required', 'email', 'max:255'],
            'provider.password' => ['required', 'string', 'min:8', 'max:255'],
            'provider.providerUrl' => ['nullable', 'url', 'max:255'],
            'provider.customSteps' => ['nullable', 'array'],
            'testUrl' => ['required', 'url', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'provider.required' => __('testprovider::validation.provider.required'),
            'testUrl.required' => __('testprovider::validation.testUrl.required'),
            'testUrl.url' => __('testprovider::validation.testUrl.url'),
        ];
    }
}
