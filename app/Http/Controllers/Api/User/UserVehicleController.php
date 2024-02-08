<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserVehicle\UploadUserVehicleFileRequest;
use App\Http\Requests\UserVehicle\UserVehicleStoreRequest;
use App\Http\Requests\Vehicle\VehicleStoreRequest;
use App\Http\Resources\UserVehicle\UserVehicleResource;
use App\Models\UserVehicle;
use App\Services\Admin\VehicleService;
use App\Services\User\FileService;
use App\Services\User\ReviewService;
use App\Services\User\UserVehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVehicleController extends Controller
{

    /**
     * @OA\Tag(
     *      name="User Vehicle",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */


    public function __construct(
        private UserVehicleService $userVehicleService,
        private FileService $fileService
    )
    {}





/**
     * @OA\Post(
     *      path="/api/vehicles/user",
     *      operationId="createUserVehicle",
     *      tags={"User Vehicle"},
     *      summary="create user vehicle",
     *      description="create user vehicle",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="vehicle_id",
     *          description="vehicle_id",
     *          example="1",
     *          @OA\Schema(type="integer")
     *          ),
     *      @OA\Property(
     *          property="plate_number",
     *          description="plate_number",
     *          example="12k123r",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="color",
     *          description="color",
     *          example="black",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="year_model",
     *          description="year_model",
     *          example="2023",
     *          @OA\Schema(type="string")
     *          ),
     *     ),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUserVehicle(UserVehicleStoreRequest $request)
    {
        $userId = auth('sanctum')->id();
        $vehicle = $this->userVehicleService->createUserVehicle($userId, $request);
        return $this->successJsonResponse(UserVehicleResource::make($vehicle));
    }



    /**
     * @OA\Put(
     *      path="/api/vehicles/user/{userVehicleId}",
     *      operationId="updateUserVehicle",
     *      tags={"User Vehicle"},
     *      summary="update user vehicle",
     *      description="update user vehicle",
     *      security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="userVehicleId",
     *         description="user vehicle id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="vehicle_id",
     *          description="vehicle_id",
     *          example="1",
     *          @OA\Schema(type="integer")
     *          ),
     *      @OA\Property(
     *          property="plate_number",
     *          description="plate_number",
     *          example="12k123r",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="color",
     *          description="color",
     *          example="black",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="year_model",
     *          description="year_model",
     *          example="2023",
     *          @OA\Schema(type="string")
     *          ),
     *     ),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserVehicle(UserVehicleStoreRequest $request, UserVehicle $userVehicle)
    {
        if($userVehicle['status'] != 0){
            return $this->errorResponse(UserVehicleResource::make($userVehicle), 'you cant edit anymore');
        }
        $vehicle = $this->userVehicleService->updateUserVehicle($userVehicle, $request);
        return $this->successJsonResponse(UserVehicleResource::make($vehicle));
    }



    /**
     * @OA\Delete(
     *      path="/api/vehicles/user/{userVehicleId}",
     *      operationId="deleteUserVehicle",
     *      tags={"User Vehicle"},
     *      summary="delete user vehicle",
     *      description="delete user vehicle",
     *      security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="userVehicleId",
     *         description="user vehicle id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUserVehicle(UserVehicle $userVehicle)
    {
        $this->userVehicleService->deleteItem($userVehicle['id']);
        return $this->successJsonResponse();
    }




    /**
     * @OA\Post(
     *      path="/api/vehicles/user/{userVehicleId}/upload-file",
     *      operationId="uploadVehicleFile",
     *      tags={"User Vehicle"},
     *      summary="upload user vehicle file",
     *      description="upload user vehicle file",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="userVehicleId",
     *         description="user vehicle id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="image",
     *          description="image",
     *          example="test",
     *          type="file",
     *          @OA\Schema(type="string", format="binary")
     *          ),
     *      @OA\Property(
     *          property="type",
     *          description="type",
     *          example="vehicle_card_back,vehicle_card_front",
     *          @OA\Schema(type="string")
     *          ),
     *     ),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadVehicleFile(UploadUserVehicleFileRequest $request, UserVehicle $userVehicle)
    {
        $user = auth('sanctum')->user();
        $image = $this->fileService->uploadImage($user['id'], $request['image'], $userVehicle, $directory='images', $request->input('type'));
        $vehicle = $this->userVehicleService->showItem($user['id']);
        return $this->successJsonResponse(UserVehicleResource::make($user));
    }


}