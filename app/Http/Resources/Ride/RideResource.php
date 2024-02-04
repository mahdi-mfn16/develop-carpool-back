<?php

namespace App\Http\Resources\Ride;

use App\Http\Resources\City\CityResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RideResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user'=> UserResource::make($this->whenLoaded('user')),
            'origin'=> CityResource::make($this->whenLoaded('origin')),
            'destination'=> CityResource::make($this->whenLoaded('destination')),
            'origin_address'=> [
                'full_address' => $this->origin_address,
                'lng' => $this->origin_lng,
                'lat' => $this->origin_lat,
            ],
            'destination_address'=> [
                'full_address' => $this->destination_address,
                'lng' => $this->destination_lng,
                'lat' => $this->destination_lat,
            ], 
            'capacity'=> $this->capacity,
            'type'=> $this->type,
            'booked'=> $this->booked,
            'distance'=> $this->distance,
            'date'=> Carbon::parse($this->date)->format('Y-m-d'),
            'start_time'=> $this->start_time,
            'end_time'=> $this->end_time,
            'price'=> $this->price,
            'fee'=> $this->fee,
            'status'=> $this->status,

        ];
    }
}