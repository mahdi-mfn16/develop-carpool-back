<?php

namespace App\Http\Resources\File;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FileCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> FileResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
