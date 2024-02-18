<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAdminIndexRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Tag( name="Admin - User", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private UserService $userService
    )
    {}



    /**
     * @OA\Get(
     *      path="/api/admin/users",
     *      operationId="getAdminUsers",
     *      tags={"Admin - User"},
     *      summary="get list of users",
     *      description="get list of users",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
    *       @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
    *       @OA\Parameter( name="filters[privilege]", in="query", description="privilege", @OA\Schema( type="string", example="" ) ),
    *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UserAdminIndexRequest $request)
    {
        $users = $this->userService->getUserList($request);
        return $this->successPaginateResponse(new UserCollection($users));
    }



    /**
     * @OA\Get(
     *      path="/api/admin/users/{userId}",
     *      operationId="showAdminUser",
     *      tags={"Admin - User"},
     *      summary="show one user",
     *      description="show one user",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="userId", description="user id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        $user = $this->userService->showItem($user['id']);
        return $this->successArrayResponse(UserResource::make($user));
    }



}
