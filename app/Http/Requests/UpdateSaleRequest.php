<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'sometimes|required|exists:products,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'total_price' => 'sometimes|required|numeric|min:0',
            'sale_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|string|in:pending,completed,canceled',
        ];
    }
}
