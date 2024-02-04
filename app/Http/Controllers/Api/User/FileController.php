<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UpdateProfileImageRequest;
use App\Http\Requests\Image\UploadImageRequest;
use App\Models\File;
use App\Models\Image;
use App\Services\User\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{


    public function __construct(
        private FileService $imageService
    ){}


    /**
     * Display profile omage of user
     *
     */
    public function getUserImageProfile()
    {
        $userId = auth('sanctum')->id();
        $profile = $this->imageService->getUserImageProfile($userId);
        return $this->successJsonResponse($profile);
    }

    /**
     * Display list of user images
     *
     */
    public function getUserImages()
    {
        $userId = auth('sanctum')->id();
        $images = $this->imageService->getUserImages($userId);
        return $this->successArrayResponse($images);
    }

    /**
     * upload an image for one user
     *
     */
    public function uploadImage(UploadImageRequest $request)
    {
        // return $request;
        $userId = auth('sanctum')->id();
        $image = $this->imageService->uploadImage($userId, $request, $directory='images', $type='profile');
        return $this->successJsonResponse($image);
    }

    /**
     * Display the specified image for one user.
     *
     */
    public function getImage(File $image)
    {
        $image = $this->imageService->showItem($image['id']);
        return $this->successJsonResponse($image);
    }


    /**
     * Update the main image profile in storage.
     *
     */
    public function updateMainProfileImage(UpdateProfileImageRequest $request)
    {
        $userId = auth('sanctum')->id();
        $images = $this->imageService->updateMainProfileImage($userId, $request['image_id']);
        return $this->successArrayResponse($images);
    }

    /**
     * Remove the specified image from storage.
     *
     */
    public function deleteImage(File $image)
    {
        $this->imageService->deleteImage($image);
        return $this->successJsonResponse();
    }
}





