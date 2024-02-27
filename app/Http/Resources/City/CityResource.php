<?php

namespace App\Http\Resources\City;

use App\Http\Resources\Province\ProvinceResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CityResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'province' => ProvinceResource::make($this->whenLoaded('province')),
        ];
    }
}
