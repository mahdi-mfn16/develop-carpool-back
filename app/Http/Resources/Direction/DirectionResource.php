<?php

namespace App\Http\Resources\Direction;

use App\Http\Resources\Province\ProvinceResource;
use App\Http\Resources\Ride\RideResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class DirectionResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'route_index' => $this->lat,
            'coordinates' => unserialize($this->coordinates),
            'distance' => $this->distance,
            'time' => Carbon::parse($this->time)->format('H:i'),
            'ride' => RideResource::make($this->whenLoaded('ride')),
        ];
    }
}
