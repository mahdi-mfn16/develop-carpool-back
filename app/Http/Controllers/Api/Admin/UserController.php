<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserStatusRequest;
use App\Http\Requests\User\UserAdminIndexRequest;
use App\Http\Requests\User\UserFileAdminIndexRequest;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\File;
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
    *       @OA\Parameter( name="filters[bio_status]", in="query", description="bio status", @OA\Schema( type="integer", example="" ) ),
    *       @OA\Parameter( name="filters[status]", in="query", description="status", @OA\Schema( type="integer", example="" ) ),
    *       @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
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



    /**
     * @OA\Put(
     *      path="/api/admin/users/update-status/{userId}",
     *      operationId="updateStatusAdminUser",
     *      tags={"Admin - User"},
     *      summary="update status one user",
     *      description="update status one user",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="userId", description="user id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *        @OA\Property(property="type", description="type", example="selfie,drive_license,bio", @OA\Schema(type="string") ),
     *        @OA\Property(property="action", description="action", example="accepted,rejected", @OA\Schema(type="string") ),
     *        @OA\Property(property="message", description="message", example="", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(UpdateUserStatusRequest $request, User $user)
    {
        $this->userService->updateUserInfoStatus($user, $request);
        return $this->successJsonResponse();
    }



    /**
     * @OA\Get(
     *      path="/api/admin/users/files/{userId}",
     *      operationId="getAdminUserFiles",
     *      tags={"Admin - User"},
     *      summary="get list of user files",
     *      description="get list of user files",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="userId", description="user id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
    *       @OA\Parameter( name="filters[type]", in="query", description="type", @OA\Schema( type="string", example="" ) ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserFiles(UserFileAdminIndexRequest $request, User $user)
    {
        $files = $this->userService->getUserFiles($user, $request);
        return $this->successPaginateResponse(new FileCollection($files));
    }




    /**
     * @OA\Put(
     *      path="/api/admin/users/verify-profile/{fileId}",
     *      operationId="verifyUserProfile",
     *      tags={"Admin - User"},
     *      summary="verify user profile",
     *      description="verify user profile",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="fileId", description="file id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyProfile(File $file)
    {
        $this->userService->verifyProfile($file);
        return $this->successJsonResponse();
    }



}
