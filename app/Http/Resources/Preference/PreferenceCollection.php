<?php

namespace App\Http\Resources\Preference;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PreferenceCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> PreferenceResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
