<?php

// modules/User/Http/Requests/UploadAvatarRequest.php

declare(strict_types=1);

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UploadAvatarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => __('user::validation.avatar.required'),
            'avatar.image' => __('user::validation.avatar.image'),
            'avatar.max' => __('user::validation.avatar.max'),
        ];
    }
}
