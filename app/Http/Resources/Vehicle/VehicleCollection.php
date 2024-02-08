<?php

namespace App\Http\Resources\Vehicle;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> VehicleResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
