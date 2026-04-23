<?php

// Ticket/Http/Requests/StoreTicketRequest.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'min:5', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            'priority' => ['sometimes', 'in:low,medium,high'],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => __('ticket::validation.subject.required'),
            'message.required' => __('ticket::validation.message.required'),
        ];
    }
}
