<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\Admin\VehicleService;
use App\Services\User\ReviewService;
use App\Services\User\UserVehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVehicleController extends Controller
{


    public function __construct(
        private UserVehicleService $userVehicleService
    )
    {}





    // public function getUserVehicles(UserVehicleIndexRequest $request)
    // {
    //     $user = auth('sanctum')->user();
    //     $user = $this->userService->showItem($user['id']);
    //     return $this->successArrayResponse(UserResource::make($user));
    // }



    // public function createUserVehicle(UploadUserFileRequest $request)
    // {
    //     $user = auth('sanctum')->user();
    //     $image = $this->fileService->uploadImage($user['id'], $request->input('image'), $user, $directory='images', $request->input('type'));
    //     $user = $this->userService->showItem($user['id']);
    //     return $this->successJsonResponse(UserResource::make($user));
    // }


    // public function deleteUserVehicle(UploadUserFileRequest $request)
    // {
    //     $user = auth('sanctum')->user();
    //     $image = $this->fileService->uploadImage($user['id'], $request->input('image'), $user, $directory='images', $request->input('type'));
    //     $user = $this->userService->showItem($user['id']);
    //     return $this->successJsonResponse(UserResource::make($user));
    // }


}