<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ClaimRewardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rewardId' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'rewardId.required' => __('referral::validation.rewardId.required'),
        ];
    }
}
