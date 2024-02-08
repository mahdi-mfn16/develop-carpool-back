<?php

namespace App\Http\Resources\Preference;

use App\Http\Resources\PreferenceOption\PreferenceOptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PreferenceResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name' => $this->name,
            'text' => $this->text,
            'options' => UserPreferenceOptionResource::collection($this->whenLoaded('options'))
        ];
    }
}
