<?php

namespace App\Http\Resources\PreferenceOption;

use App\Http\Resources\Preference\PreferenceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PreferenceOptionResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'text' => $this->text,
            'preference' => PreferenceResource::make($this->whenLoaded('preference')),
        ];
    }
}
