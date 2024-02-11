<?php

namespace App\Http\Resources\Report;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> ReportResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
