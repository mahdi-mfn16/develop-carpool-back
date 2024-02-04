<?php

namespace App\Http\Resources\Province;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProvinceResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name'=> $this->name,
        ];
    }
}
