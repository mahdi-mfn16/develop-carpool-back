<?php

namespace App\Http\Requests\RideApply;

use Illuminate\Foundation\Http\FormRequest;

class StoreRideApplyRequest extends FormRequest
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
            'capacity' => 'required|numeric|min:1',
        ];
    }
}
