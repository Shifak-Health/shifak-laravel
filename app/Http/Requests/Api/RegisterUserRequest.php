<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;

class RegisterUserRequest extends FormRequest
{
    use WithHashedPassword;

    /**
     * Determine if the supervisor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'],
            'type' => ['required', 'in:user,pharmacy'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'national_id' => ['required', 'string', 'max:14', 'unique:users,national_id'],
            'birthdate' => ['nullable', 'date'],
            'gender' => ['nullable', 'string'],
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.required' => trans('validation.phone_required'),
            'email.required' => trans('validation.email_required'),
            'password.required' => trans('validation.password_required'),
        ];
    }

    /**
     * Apply additional logic like hashing password.
     *
     * @return array
     */
    public function allWithHashedPassword()
    {
        return array_merge($this->all(), [
            'password' => bcrypt($this->password),
        ]);
    }
}
