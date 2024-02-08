<?php

namespace App\Http\Resources\UserVehicle;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserVehicleCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> UserVehicleResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
