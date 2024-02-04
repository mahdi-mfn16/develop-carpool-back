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
        
    }



    public function getUserImageProfile($userId)
    {
        return $this->model
        ->where('user_id', $userId)
        ->where('confirmed', 1)
        ->where('is_profile', 1)
        ->first();
    }



    public function uploadImage($userId, $data, $directory='images', $type = 'profile')
    {
        // upload on storage
        $hasProfile = $this->getUserImageProfile($userId);
        $image = $this->uploadFile($userId, $data['image'], $directory, $type);


        return $this->model->create([
            'user_id' => $userId,
            'name' => $image['name'],
            'url' => $image['url'],
            'is_profile' => $hasProfile ? 0 : 1,
            'confirmed' => 0

        ]);
    }



    public function updateMainProfileImage($userId, $imageId)
    {
        $this->model->where('user_id', $userId)
        ->where('is_profile', 1)->update([
            'is_profile' => 0
        ]);

        $this->model->where('id', $imageId)
        ->where('user_id', $userId)->update([
            'is_profile' => 1
        ]);

        return $this->model->where('user_id', $userId)->get();
        
    }



    private function uploadFile($userId, $file, $directory = 'images', $type = 'profile')
    {
       
        $fileHash = floor(microtime(true) * 1000);
        $name = $userId.$fileHash.'.'.$file->extension();

        $path = $directory.'/'.$type.'/'.$name;
        
        Storage::put($path, file_get_contents($file));

        return ['name' => $name, 'url' => $path];
    }


    public function deleteImage($image)
    {
        Storage::delete($image['url']);
        return $image->delete();
    }



    
}