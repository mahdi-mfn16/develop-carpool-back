<?php

namespace App\Http\Resources\Preference;

use App\Http\Resources\Preference\PreferenceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPreferenceOptionResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this['id'],
            'text' => $this['text'],
            'has' => $this['has']
        ];
    }
}
