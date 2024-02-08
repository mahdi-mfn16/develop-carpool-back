<?php

namespace App\Http\Requests\UserVehicle;

use Illuminate\Foundation\Http\FormRequest;

class UserVehicleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehicle_id'=>'required|numeric|exists:vehicles,id',
            'color' =>'required|string',
            'year_model'=>'required|numeric',
            'plate_number' => 'required|string',
        ];
    }
}
