<?php

// modules/Download/Http/Requests/RequestDownloadRequest.php

declare(strict_types=1);

namespace Modules\Download\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RequestDownloadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => ['required', 'url', 'max:2048'],
            'previewToken' => ['nullable', 'string', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => __('download::validation.url.required'),
        ];
    }
}
