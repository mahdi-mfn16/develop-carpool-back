<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserVehicle\UpdateUserVehicleStatusRequest;
use App\Http\Requests\UserVehicle\UserVehicleIndexRequest;
use App\Http\Resources\UserVehicle\UserVehicleCollection;
use App\Http\Resources\UserVehicle\UserVehicleResource;
use App\Models\UserVehicle;
use App\Services\User\FileService;
use App\Services\User\UserVehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserVehicleController extends Controller
{

    /**
     * @OA\Tag( name="Admin - User Vehicle", @OA\ExternalDocumentation( description="", url="" ) )
     */


    public function __construct(
        private UserVehicleService $userVehicleService,
        private FileService $fileService
    )
    {}



    /**
     * @OA\Get(
     *      path="/api/admin/vehicles/user",
     *      operationId="getAdminUserVehicles",
     *      tags={"Admin - User Vehicle"},
     *      summary="get list of user vehicles ",
     *      description="get list of user vehicles ",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[user_id]", in="query", description="user id", @OA\Schema( type="integer", example="" ) ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UserVehicleIndexRequest $request)
    {
        $userVehicles = $this->userVehicleService->getUserVehicles($request);
        return $this->successPaginateResponse(new UserVehicleCollection($userVehicles));
    }



    /**
     * @OA\Get(
     *      path="/api/admin/vehicles/user/{userVehicleId}",
     *      operationId="showAdminUserVehicle",
     *      tags={"Admin - User Vehicle"},
     *      summary="show one user vehicle",
     *      description="show one user vehicle",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="userVehicleId", description="user vehicle id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(UserVehicle $userVehicle)
    {
        $userVehicle = $this->userVehicleService->showItem($userVehicle['id']);
        return $this->successJsonResponse(UserVehicleResource::make($userVehicle));
    }



    /**
     * @OA\Put(
     *      path="/api/admin/vehicles/user/update-status/{userVehicleId}",
     *      operationId="updateStatusAdminUserVehicle",
     *      tags={"Admin - User Vehicle"},
     *      summary="update status one user vehicle",
     *      description="update status one user vehicle",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="userVehicleId", description="user vehicle id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="action", description="action", example="accepted,rejected", @OA\Schema(type="string") ),
     *       @OA\Property(property="message", description="message", example="", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(UpdateUserVehicleStatusRequest $request, UserVehicle $userVehicle)
    {
        $this->userVehicleService->updateStatus($userVehicle, $request);
        return $this->successJsonResponse();
    }






}