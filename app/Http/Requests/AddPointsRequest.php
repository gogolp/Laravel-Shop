<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPointsRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'order_id' => 'nullable|integer|exists:orders,id',
            'amount' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'User id is required',
            'order_id.exist' => 'Order does not exist',
            'amount.required' => 'Amount is required',
            'description.max' => 'Max length is 255 characters',
        ];
    }
}
