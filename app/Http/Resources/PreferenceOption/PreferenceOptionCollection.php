<?php

namespace App\Http\Resources\PreferenceOption;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PreferenceOptionCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> PreferenceOptionResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
