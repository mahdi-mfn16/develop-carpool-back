<?php

namespace App\Http\Requests\Ride;

use Illuminate\Foundation\Http\FormRequest;

class RideDuplicateRequest extends FormRequest
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
            'origin.city_id' => 'required|exists:cities,id',
            'origin.name' => 'required|string',
            'origin.lat' => 'required|numeric|min:-90|max:90',
            'origin.lng' => 'required|numeric|min:-180|max:180',
            'destination' => 'required|array',
            'destination.city_id' => 'required|exists:cities,id',
            'destination.name' => 'required|string',
            'destination.lat' => 'required|numeric|min:-90|max:90',
            'destination.lng' => 'required|numeric|min:-180|max:180',
            'direction' => 'required|array',
            'direction.name' => 'required|string',
            'direction.coordinates' => 'required|array',
            'direction.route_index' => 'required|numeric',
            'direction.distance' => 'required|string',
            'direction.time' => 'required|date_format:H:i',
            'type' => 'required|in:rider,passenger',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'user_vehicle_id' => 'required|exists:user_vehicles,id',
            'capacity' => 'required|numeric|min:1|max:4',
            'price' => 'required|numeric|min:0',
            'description' => 'sometimes|nullable|string',
        ];
    }
}
