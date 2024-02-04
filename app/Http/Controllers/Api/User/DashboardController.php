<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SearchUserRequest;
use App\Models\Message;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    public function __construct(
        private UserService $userService
    ){}




    public function searchUsers(SearchUserRequest $request)
    {
        // $user = auth('sanctum')->user();
        // $users = $this->userService->searchUsers($user, $request);
        // return $this->successArrayResponse($users);
    }



    public function homeUsers(Request $request)
    {
        // $user = auth('sanctum')->user();
        // $users = $this->userService->getHomeUsers($user, $request);
        // return $this->successArrayResponse($users);
    }


}
