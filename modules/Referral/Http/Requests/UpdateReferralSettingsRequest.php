<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateReferralSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'isEnabled' => ['required', 'boolean'],
            'referralsRequired' => ['required', 'integer', 'min:1', 'max:100'],
            'rewardType' => ['required', 'string', 'max:50'],
            'rewardDuration' => ['required', 'integer', 'min:1', 'max:365'],
            'rewardExpiryDays' => ['required', 'integer', 'min:1', 'max:365'],
            'welcomeMessage' => ['nullable', 'string', 'max:500'],
            'successMessage' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'referralsRequired.min' => __('referral::validation.referralsRequired.min'),
            'rewardDuration.min' => __('referral::validation.rewardDuration.min'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'isEnabled' => $this->boolean('isEnabled'),
            'referralsRequired' => (int) $this->input('referralsRequired'),
            'rewardDuration' => (int) $this->input('rewardDuration'),
            'rewardExpiryDays' => (int) $this->input('rewardExpiryDays'),
        ]);
    }
}
