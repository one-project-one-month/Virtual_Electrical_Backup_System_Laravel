<?php

namespace App\Http\Requests\ElectricalAccessory;

use Illuminate\Foundation\Http\FormRequest;

class ElectricalAccessoryRequest extends FormRequest
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
            'device_name'=>'required|max:255|string|unique:electrical_accessories,device_name',
            'watt'=>'required|numeric',
            'pure_sine_wave'=>'boolean',
            'image'=>'mimes:png,jpg'
        ];
    }
}
