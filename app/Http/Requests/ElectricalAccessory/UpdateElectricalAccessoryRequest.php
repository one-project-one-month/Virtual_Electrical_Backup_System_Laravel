<?php

namespace App\Http\Requests\ElectricalAccessory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateElectricalAccessoryRequest extends FormRequest
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
            'device_name'=>'required|max:255|string|unique:electrical_accessories,device_name,'.$this->electrical_accessory->id,
            'watt'=>'required|numeric',
            'pure_sine_wave'=>'boolean',
            'image'=>'mimes:png,jpg'
        ];
    }
}
