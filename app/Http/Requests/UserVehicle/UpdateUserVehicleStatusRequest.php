<?php

namespace App\Http\Requests\UserVehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserVehicleStatusRequest extends FormRequest
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
            'action' => 'required|string|in:accepted,rejected',
            'message' => 'sometimes|nullable',
        ];
    }
}
