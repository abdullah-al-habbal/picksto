<?php

// modules/Subscription/Http/Requests/PurchasePackageRequest.php

declare(strict_types=1);

namespace Modules\Subscription\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Package\Models\PackageModel;

final class PurchasePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'packageId' => [
                'required',
                'exists:packages,id',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $package = PackageModel::find($value);
                    if ($package && ! $package->is_active) {
                        $fail(__('subscription::validation.packageId.inactive'));
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'packageId.required' => __('subscription::validation.packageId.required'),
            'packageId.exists' => __('subscription::validation.packageId.exists'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'packageId' => (int) $this->input('packageId'),
        ]);
    }
}
