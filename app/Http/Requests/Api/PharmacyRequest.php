<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add more complex authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'hotline' => ['required', 'string', 'max:20'],
            'image' => ['nullable', 'string', 'max:2048'], // Allow image file types
            'is_active' => ['boolean'],
            'user_id' => ['required', 'unique:pharmacies,user_id', 'exists:users,id'], // Make sure user exists in the users table
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Pharmacy name is required.',
            'hotline.required' => 'Pharmacy hotline is required.',
            'user_id.required' => 'A valid user is required to assign to the pharmacy.',
        ];
    }
}
