<?php

namespace App\Http\Requests\Ride;

use Illuminate\Foundation\Http\FormRequest;

class RideIndexRequest extends FormRequest
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
            'limit' => 'required|numeric',
            'page' => 'required|numeric',
            'filters' => 'required|array',
            'filters.origin' => 'required|numeric|exists:cities,id',
            'filters.destination' => 'required|numeric|exists:cities,id',
            'filters.capacity' => 'required|numeric|min:1',
            'filters.date' => 'required|date_format:Y-m-d',
            'filters.gender' => 'sometimes|nullable|in:0,1',
        ];
    }
}
