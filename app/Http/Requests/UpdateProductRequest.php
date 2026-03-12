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
        // Change this to true so the owner can actually save the gown!
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Ensure the Shopee Tag ID is unique and follows our GW-01 format
            'item_code' => 'required|string|max:20|unique:products,item_code',

            // The gown MUST belong to a category (Gown, Suit, etc.)
            'category_id' => 'required|exists:categories,id',

            // These are nullable because if empty, we inherit the Category price
            'custom_rental_fee' => 'nullable|numeric|min:0',
            'custom_security_deposit' => 'nullable|numeric|min:0',

            // Specifics (Color, Size, etc.) coming from the JSON payload
            'specifics' => 'nullable|array',

            'internal_notes' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Custom error messages so it doesn't sound like "computer-speak" to her.
     */
    public function messages(): array
    {
        return [
            'item_code.required' => 'Please enter the Tag ID (e.g., GW-01).',
            'item_code.unique' => 'The Tag ID ":input" is already assigned to a different item.',
            'category_id.required' => 'You must select a Category (Gown/Suit/etc).',
            'category_id.exists' => 'The selected category is invalid.',
        ];
    }
}
