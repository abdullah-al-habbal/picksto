<?php

declare(strict_types=1);

namespace Modules\Upload\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UploadImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'image', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => __('upload::validation.file.required'),
            'file.image' => __('upload::validation.file.image'),
            'file.max' => __('upload::validation.file.max'),
        ];
    }
}
