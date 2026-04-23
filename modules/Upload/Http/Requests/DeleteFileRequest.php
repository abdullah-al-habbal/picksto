<?php

declare(strict_types=1);

namespace Modules\Upload\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class DeleteFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'folder' => ['required', 'in:logos,favicons,products,avatars,thumbnails'],
            'filename' => ['required', 'string', 'regex:/^[a-zA-Z0-9_\-\.]+\.(jpg|jpeg|png|webp|gif|svg)$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'folder.required' => __('upload::validation.folder.required'),
            'folder.in' => __('upload::validation.folder.in'),
            'filename.required' => __('upload::validation.filename.required'),
            'filename.regex' => __('upload::validation.filename.regex'),
        ];
    }
}
