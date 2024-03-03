<?php

namespace App\Http\Requests\job_seeker;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'job_title' => 'required|string',
            'company_name' => 'required|string',
            'job_location_city' => 'nullable|string',
            'job_location_state' => 'nullable|string',
            'job_location_country' => 'nullable|string',
            'description' => 'nullable|string',
            'is_current_job' => 'nullable'
        ];
    }
}
