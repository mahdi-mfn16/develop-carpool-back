<?php

namespace App\Http\Resources\ReportType;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportTypeCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> ReportTypeResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
