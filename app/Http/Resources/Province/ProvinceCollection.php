<?php

namespace App\Http\Resources\Province;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProvinceCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> ProvinceResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
