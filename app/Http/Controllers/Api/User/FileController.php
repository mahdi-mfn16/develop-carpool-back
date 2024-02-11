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
     * Remove the specified image from storage.
     *
     */
    public function deleteImage(File $image)
    {
        $this->imageService->deleteImage($image);
        return $this->successJsonResponse();
    }
}





