<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'role_id' => 'required|integer',
            'full_name' => 'required|string',
            'user_name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string',
            'is_active' => 'required|boolean',
            'created_by' => 'required|integer',
        ];
    }
}
