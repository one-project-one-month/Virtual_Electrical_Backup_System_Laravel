<?php

namespace App\Http\Requests\InverterType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InverterTypeUpdateRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'efficiency' => 'required|numeric|between:60,95',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The inverter name is required.',
            'efficiency.required' => 'Efficiency is required.',
            'efficiency.numeric' => 'Efficiency must be a numeric value.',
            'efficiency.between' => 'Efficiency must be between 60% and 95%.',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException( response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }
}
