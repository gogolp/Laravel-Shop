<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'price_uah' => 'sometimes|numeric|min:0',
            'price_it_coins' => 'nullable|integer|min:0',
            'cashback_percent' => 'nullable|integer|min:0|max:100',
            'is_active' => 'nullable|boolean',
            'tag' => 'nullable|string|max:100',
        ];
    }
}
