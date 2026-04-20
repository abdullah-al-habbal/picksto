<?php
// modules/Download/Http/Requests/PreviewDownloadRequest.php

declare(strict_types=1);

namespace Modules\Download\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class PreviewDownloadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => ['required', 'url', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => __('download::validation.url.required'),
            'url.url' => __('download::validation.url.url'),
        ];
    }
}
