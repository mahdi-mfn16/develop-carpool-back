<?php

namespace App\Http\Resources\UserVehicle;

use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserVehicleResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'color' => $this->color,
            'year_model' => $this->year_model,
            'plate_number' => $this->plate_number,
            'status' => $this->status,
            'vehicle' => VehicleResource::make($this->whenLoaded('vehicle')),
        ];
    }
}
