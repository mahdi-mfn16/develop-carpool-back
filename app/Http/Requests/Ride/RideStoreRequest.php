<?php

namespace App\Http\Requests\Ride;

use Illuminate\Foundation\Http\FormRequest;

class RideStoreRequest extends FormRequest
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
            'origin' => 'required|array',
            'destination' => 'required|array',
            'type' => 'required|in:rider,passenger',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'capacity' => 'required|numeric|min:1|max:4',
            'price' => 'required|numeric|min:0',
            'description' => 'sometimes|nullable|string',
        ];
    }
}
