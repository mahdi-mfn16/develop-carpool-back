<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'path'=> config('filesystems.public_root').$this->path,
            'type'=> $this->type,
            'status'=> $this->status,

        ];
    }
}
