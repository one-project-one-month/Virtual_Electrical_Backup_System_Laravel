<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBatteryRequest extends FormRequest
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
            //
            'battery_name' => 'required|string|max:255',
            'storage_amp' => 'required|numeric|min:0',
            'battery_volt' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:500',
            'brand_id' => 'required|integer|exists:brand,id',
            'battery_type_id' => 'required|integer|exists:battery_types,id',
        ];
    }
}