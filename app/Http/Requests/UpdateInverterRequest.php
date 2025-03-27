<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateInverterRequest extends FormRequest
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
            'watt' => 'sometimes|required|integer|min:1',
            'inverter_type_id' => 'sometimes|required|exists:inverter_types,id',
            'brand_id' => 'sometimes|required|exists:brands,id',
            'wave_type' => 'sometimes|required|string',
            'model' => 'sometimes|required|string',
            'inverter_volt' => 'sometimes|required|numeric',
            'compatible_battery' => 'sometimes|required|string',
            'inverter_price' => 'sometimes|required|decimal:2,10',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'sometimes|required|string',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => 'inverter-update-fail',
            'status' => '422',
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ]));
    }
}
