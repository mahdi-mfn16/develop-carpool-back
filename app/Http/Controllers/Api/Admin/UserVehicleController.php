<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserVehicle\UploadUserVehicleFileRequest;
use App\Http\Requests\UserVehicle\UserVehicleIndexRequest;
use App\Http\Requests\UserVehicle\UserVehicleStoreRequest;
use App\Http\Requests\Vehicle\VehicleStoreRequest;
use App\Http\Resources\UserVehicle\UserVehicleCollection;
use App\Http\Resources\UserVehicle\UserVehicleResource;
use App\Models\UserVehicle;
use App\Services\Admin\VehicleService;
use App\Services\User\FileService;
use App\Services\User\ReviewService;
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



}