<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInverterRequest extends FormRequest
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
            'watt' => 'required|integer|min:1',
            'inverter_type_id' => 'required|exists:inverter_types,id',
            'brand_id' => 'required|exists:brands,id',
            'wave_type' => 'required|string',
            'model' => 'required|string',
            'inverter_volt' => 'required|numeric',
            'compatible_battery' => 'required|string',
            'inverter_price' => 'required|decimal:2,10',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'description' => 'required|string',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => 'inverter-fail',
            'status' => '422',
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ]));
    }
}
