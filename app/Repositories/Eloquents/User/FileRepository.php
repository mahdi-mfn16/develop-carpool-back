<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\File;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\FileRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [];    
    }



    public function uploadImage($userId, $data, $filableModel, $directory='images', $type = 'profile')
    {
        // upload on storage
        $image = $this->uploadFile($userId, $data, $directory, $type);


        return $this->model->create([
            'user_id' => $userId,
            'name' => $image['name'],
            'path' => $image['path'],
            'type' => $type,
            'filable_id' => $filableModel['id'],
            'filable_type' => get_class($filableModel),
            'status' => 0

        ]);
    }




    private function uploadFile($userId, $file, $directory = 'images', $type = 'profile')
    {
       
        $fileHash = floor(microtime(true) * 1000);
        $name = $userId.$fileHash.'.'.$file->extension();

        $path = $directory.'/'.$type.'/'.$name;
        
        Storage::put('public/'.$path, file_get_contents($file));

        return ['name' => $name, 'path' => $path];
    }


    public function deleteImage($image)
    {
        Storage::delete($image['path']);
        return $image->delete();
    }



    
}