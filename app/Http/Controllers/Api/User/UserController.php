<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Preference\UpdateUserPreferenceRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CheckCodeRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UploadUserFileRequest;
use App\Http\Requests\User\UploadUserProfileRequest;
use App\Http\Resources\User\MyUserResource;
use App\Http\Resources\User\UserResource;
use App\Models\Preference;
use App\Models\User;
use App\Services\Admin\PreferenceService;
use App\Services\User\FileService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @OA\Tag(
     *      name="User",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    public function __construct(
        private UserService $userService,
        private FileService $fileService,
        private PreferenceService $preferenceService
    ){}

  

    /**
     * @OA\Get(
     *      path="/api/users/my-info",
     *      operationId="getMyInfo",
     *      tags={"User"},
     *      summary="get auth user",
     *      description="get auth user ",
     *      security={{"bearer_token":{}}},
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

    public function getMyInfo()
    {
        $userId = auth('sanctum')->id();
        $user = $this->userService->showItem($userId);
        return $this->successJsonResponse(MyUserResource::make($user));
    }




      /**
     * @OA\Get(
     *      path="/api/users/user-info/{userId}",
     *      operationId="getUserInfo",
     *      tags={"User"},
     *      summary="get one user",
     *      description="get one user ",
     *      security={{"bearer":{}}},
     *      @OA\Parameter( name="userId", description="user id", in = "path", @OA\Schema(type="integer") ),
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

     public function getUserInfo(User $user)
     {
        $user = $this->userService->showItem($user['id']);
        return $this->successJsonResponse(UserResource::make($user));
     }


  



   /**
     * @OA\Post(
     *      path="/api/users/complete-profile",
     *      operationId="createOrUpdateUserData",
     *      tags={"User"},
     *      summary="complete user profile",
     *      description="complete user profile",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="name",
     *          description="name",
     *          example="mehdi",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="family",
     *          description="family",
     *          example="firoozi",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="birth_day",
     *          description="birth_day",
     *          example="1995-12-12",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="gender",
     *          description="gender",
     *          example="1",
     *          @OA\Schema(type="integer")
     *          ),
     *      @OA\Property(
     *          property="national_code",
     *          description="national_code",
     *          example="2123134145",
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
    public function createOrUpdateUserData(CreateUserRequest $request)
    {
        $user = auth('sanctum')->user();
        if($user['status'] != 0){
            return $this->errorResponse(MyUserResource::make($user), 'you cant edit anymore');
        }
        $user = $this->userService->createOrUpdateUserData($user, $request);
        return $this->successJsonResponse(MyUserResource::make($user));
    }



    /**
     * @OA\Put(
     *      path="/api/users/update-bio",
     *      operationId="updateUserBio",
     *      tags={"User"},
     *      summary="update user bio",
     *      description="update user bio",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="text",
     *          description="text",
     *          example="test",
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
    public function updateUserBio(UpdateUserRequest $request)
    {
        $userId = auth('sanctum')->id();
        $user = $this->userService->updateUserBio($userId, $request);
        return $this->successJsonResponse(UserResource::make($user));
    }



    /**
     * @OA\Post(
     *      path="/api/users/upload-file",
     *      operationId="uploadUserFile",
     *      tags={"User"},
     *      summary="upload user file",
     *      description="upload user file",
     *      security={{"bearer_token":{}}},
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
     *          example="profile,drive_license_back,drive_license_front,selfie",
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
    public function uploadUserFile(UploadUserFileRequest $request)
    {
        $user = auth('sanctum')->user();
        $image = $this->fileService->uploadImage($user['id'], $request['image'], $user, $directory='images', $request->input('type'));
        $user = $this->userService->showItem($user['id']);

        return $this->successJsonResponse(UserResource::make($user));
    }



    /**
     * @OA\Put(
     *      path="/api/users/update-preference/{preferenceId}",
     *      operationId="updateUserPreference",
     *      tags={"User"},
     *      summary="update user preference",
     *      description="update user preference",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="preferenceId",
     *         description="preference id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="preference_option_id",
     *          description="preference_option_id",
     *          example="1",
     *          @OA\Schema(type="integer")
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
    public function updateUserPreference(UpdateUserPreferenceRequest $request, Preference $preference)
    {
        $user = auth('sanctum')->user();
        $info = $this->preferenceService->updateUserPreference($user, $preference, $request);
        $user = $this->userService->showItem($user['id']);

        return $this->successJsonResponse(UserResource::make($user));
    }


    /**
     * forget password 
     *
     */
    public function forgetPassword(RegisterUserRequest $request)
    {
        
        // $user = $this->userService->forgetPassword($request['mobile']);

        // if(! $user){
        //     $this->errorResponse([], 'user with this mobile number doesnt exist');
        // }
        // return $this->successJsonResponse();
    }


    /**
     * reset password 
     *
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        // $userId = auth('sanctum')->id();
        // $this->userService->resetPassword($userId, $request['password']);
        // return $this->successJsonResponse();
    }



    /**
     * change password 
     *
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        // $userId = auth('sanctum')->id();
        // $this->userService->changePassword($userId, $request['old_password'], $request['new_password']);
        // return $this->successJsonResponse();
    }



    /**
     * delete user temporarily 
     *
     */
    public function temporaryDeleteUser(User $user)
    {
        // $this->userService->deleteItem($user['id']);
        // return $this->successJsonResponse();
    }



    /**
     * delete user permanently 
     *
     */
    public function permanentDeleteUser(User $user)
    {
        // $this->userService->deleteItem($user['id']);
        // return $this->successJsonResponse();
    }


}
