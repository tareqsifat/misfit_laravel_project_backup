<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'posted_by_id' => 'required|integer',
            'job_type_id' => 'required|integer',
            'company_id' => 'required|integer',
            'deadline' => 'nullable|string',
            'job_title' => 'required|string',
            'vacancy' => 'nullable|integer',
            'job_salary' => 'nullable|integer',
            'job_location' => 'nullable|string',
            'job_description' => 'nullable|string',
        ];
    }
}
