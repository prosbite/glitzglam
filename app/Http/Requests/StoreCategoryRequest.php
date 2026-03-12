<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'prefix' => 'required|string|max:5|unique:categories,prefix',
            'default_rental_fee' => 'required|numeric|min:0',
            'default_security_deposit' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'prefix.unique' => 'The prefix ":input" is already used. Try something else like "DR" for Dress.',
            'name.unique' => 'You already have a category with this name.',
        ];
    }
}
