<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBatteryRequest extends FormRequest
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
            'battery_name' => 'sometimes|string|max:255',
            'storage_amp' => 'sometimes|numeric|min:0',
            'battery_volt' => 'sometimes|numeric|min:0',
            'battery_price' => 'sometimes|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'sometimes|string|max:500',
            'brand_id' => 'sometimes|integer|exists:brand,id',
            'battery_type_id' => 'sometimes|integer|exists:battery_types,id',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => 'battery-fail',
            'status' => '422',
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ]));
    }
}
