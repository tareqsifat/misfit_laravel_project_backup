<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PricingPlanRequest extends FormRequest
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
            'name' => 'required|string',
            'monthly_charge' => 'required|numeric',
            'yearly_charge' => 'required|numeric',
            'half_yearly_charge' => 'required|numeric',
            'flat_charge' => 'nullable|numeric|required_with:flat_time',
            'flat_time' => 'nullable|string|required_with:flat_charge',
        ];
    }
}
