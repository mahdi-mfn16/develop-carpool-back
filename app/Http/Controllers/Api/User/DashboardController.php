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





}
