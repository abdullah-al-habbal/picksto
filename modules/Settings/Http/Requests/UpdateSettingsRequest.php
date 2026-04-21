<?php

// Settings/Http/Requests/UpdateSettingsRequest.php

declare(strict_types=1);

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'siteName' => ['nullable', 'string', 'max:255'],
            'siteDescription' => ['nullable', 'string', 'max:500'],
            'logo' => ['nullable', 'string', 'url', 'max:2048'],
            'favicon' => ['nullable', 'string', 'url', 'max:2048'],
            'botBrowserVisible' => ['nullable', 'boolean'],
            'downloadProviders' => ['nullable', 'array'],
            'downloadProviders.*.name' => ['nullable', 'string', 'max:100'],
            'downloadProviders.*.email' => ['nullable', 'email', 'max:255'],
            'downloadProviders.*.providerUrl' => ['nullable', 'url', 'max:255'],
            'downloadProviders.*.supportedSites' => ['nullable', 'array'],
            'downloadProviders.*.isActive' => ['nullable', 'boolean'],
            'downloadProviders.*.priority' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'siteName.max' => __('settings::validation.siteName.max'),
            'logo.url' => __('settings::validation.logo.url'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'botBrowserVisible' => $this->boolean('botBrowserVisible'),
        ]);
    }
}
