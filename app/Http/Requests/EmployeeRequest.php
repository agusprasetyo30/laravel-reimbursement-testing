<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'     => ['required'],
            'email'    => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'nip'      => ['required', 'numeric', 'unique:users'],
            'role'     => ['required']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'rating.required' => 'Rating field is required',
            // 'limitation.required' => 'Limitation field is required',
            'role.required' => 'Role / Jurusan not selected',
        ];
    }
}
