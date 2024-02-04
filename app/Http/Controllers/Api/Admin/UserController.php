<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAdminIndexRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {}



    /**
     * get list to user
     *
     */
    public function getUserList(UserAdminIndexRequest $request)
    {
        $users = $this->userService->getUserList($request);
        return $this->successArrayResponse($users);
    }



}
