<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'price_uah' => 'required|numeric|min:0',
            'price_it_coins' => 'nullable|integer|min:0',
            'cashback_percent' => 'nullable|integer|min:0|max:100',
            'is_active' => 'nullable|boolean',
            'tag' => 'nullable|string|max:100',
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'price_uah.required' => 'Price UAH is required.',
            'cashback_percent.max' => 'Max cashback Percent is 100.',
            'tag.max' => 'Max tag is 100.',
        ];
    }
}
