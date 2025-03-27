<?php

namespace App\Http\Requests\PowerStation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePowerStationRequest extends FormRequest
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
            'watt' => 'required|integer',
            'brand_id' => 'required|integer|exists:brands,id',
            'wave_type' => 'required|string',
            'model' => 'required|string',
            'usable_watt' => 'required|integer',
            'charging_time' => 'required',
            'charging_type' => 'required|string',
            'input_watt' => 'required|integer',
            'input_amp' =>  'required|integer',
            'output_amp' => 'required|integer',
            'power_station_price' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => 'power-station-fail',
            'status' => '422',
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ]));
    }
}
