<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneratorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'model' => 'required|string',
            'watt' => 'required',
            'fuel_type' => 'required',
            'brand_id' => 'required',
            'image' => 'required',
            'generator_price' => 'required',
            'description' => 'required'
        ];
    }
}
