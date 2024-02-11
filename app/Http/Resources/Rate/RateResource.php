<?php

namespace App\Http\Resources\Rate;

use App\Http\Resources\Province\ProvinceResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RateResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'rate'=> $this->rate,
            'text'=> $this->text,
        ];
    }
}
