<?php

namespace App\Http\Resources\City;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> CityResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
