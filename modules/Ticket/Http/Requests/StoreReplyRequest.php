<?php
// Ticket/Http/Requests/StoreReplyRequest.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'min:2', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => __('ticket::validation.reply.required'),
        ];
    }
}