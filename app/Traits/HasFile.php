<?php

namespace App\Traits;

use App\Models\File;

trait HasFile
{
    public function files()
    {
        return $this->morphMany(File::class, 'filable');
    }

    public function getFileUrl($type, $verified = false)
    {
        $file = $this->files->where('type', $type);
        if($verified){
            $file = $file->where('status', 1);
        }
        $file = $file->first();

        return $file ? config('filesystems.public_root').$file->path : '';
    }

}