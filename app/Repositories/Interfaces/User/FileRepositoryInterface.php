<?php

namespace App\Repositories\Interfaces\User;


interface FileRepositoryInterface
{
    public function getUserImageProfile($userId);
    public function uploadImage($userId, $data);
    public function updateMainProfileImage($userId, $imageId);
}