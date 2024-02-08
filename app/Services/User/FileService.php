<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\FileRepositoryInterface;
use App\Services\BaseService;

class FileService extends BaseService
{
    public function __construct(
        FileRepositoryInterface $fileRepo
    )
    {
        parent::__construct($fileRepo);
    }



    public function getUserImageProfile($userId)
    {
        return $this->repository->getUserImageProfile($userId);
    }



    public function getUserImages($userId)
    {
        return $this->repository->findWithConditions(['user_id' => $userId]);
    }


    public function uploadImage($userId, $data, $filableModel, $directory, $type)
    {
        return $this->repository->uploadImage($userId, $data, $filableModel, $directory, $type);
    }



    public function updateMainProfileImage($userId, $imageId)
    {
        return $this->repository->updateMainProfileImage($userId, $imageId);
    }


    public function deleteImage( $image)
    {
        return $this->repository->deleteImage($image);
    }



    
}