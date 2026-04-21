<?php

// Product/Http/Requests/UpdateProductRequest.php

declare(strict_types=1);

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ar' => ['sometimes', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'currency' => ['sometimes', 'string', 'max:3'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'isActive' => ['nullable', 'boolean'],
            'sortOrder' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'price.numeric' => __('product::validation.price.numeric'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'isActive' => $this->boolean('isActive'),
            'sortOrder' => $this->filled('sortOrder') ? (int) $this->input('sortOrder') : null,
            'price' => $this->filled('price') ? (float) $this->input('price') : null,
        ]);
    }
}
