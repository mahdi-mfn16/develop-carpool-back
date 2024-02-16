<?php

namespace App\Http\Resources\User;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\PreferenceOption\PreferenceOptionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserCompactResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'family'=> $this->family,
            'profile' => $this->getFileUrl('profile', true),
        ];
    }
}