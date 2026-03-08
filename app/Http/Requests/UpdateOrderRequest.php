<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'location_id' => 'sometimes|integer|exists:locations,id',
            'items' => 'sometimes|array|min:1',
            'items.*.product_id' => 'sometimes|integer|exists:products,id',
            'items.*.quantity' => 'sometimes|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'location_id.required' => 'Location is required.',
            'items.required' => 'Cannot be empty',
            'items.*.quantity.min' => 'Count cannot be less than 1',
        ];
    }
}
