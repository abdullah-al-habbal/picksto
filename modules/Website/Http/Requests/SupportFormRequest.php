<?php

declare(strict_types=1);

namespace Modules\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SupportFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('website::website.support.validation.name_required'),
            'email.required' => __('website::website.support.validation.email_required'),
            'email.email' => __('website::website.support.validation.email_valid'),
            'subject.required' => __('website::website.support.validation.subject_required'),
            'message.required' => __('website::website.support.validation.message_required'),
        ];
    }
}
