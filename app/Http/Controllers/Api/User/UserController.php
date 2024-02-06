<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CheckCodeRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
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
        private UserService $userService
    ){}

  

    /**
     * @OA\Get(
     *      path="/api/users/user-info",
     *      operationId="getUserInfo",
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

    public function getUserInfo()
    {
        $userId = auth('sanctum')->id();
        $user = $this->userService->showItem($userId);
        return $this->successJsonResponse(UserResource::make($user));
    }



    /**
     * @OA\Post(
     *      path="/api/users/send-code",
     *      operationId="sendCode",
     *      tags={"User"},
     *      summary="send code again",
     *      description="send code again",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="mobile",
     *          description="mobile",
     *          example="09156326123",
     *          @OA\Schema(type="string")
     *          )
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

    public function sendCode(RegisterUserRequest $request)
    {      
        $this->userService->sendCode($request['mobile']);
        return $this->successJsonResponse();     
    }



    /**
     * @OA\Post(
     *      path="/api/users/check-code",
     *      operationId="checkUserCode",
     *      tags={"User"},
     *      summary="check user code",
     *      description="check user code",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="mobile",
     *          description="mobile",
     *          example="09156326123",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="code",
     *          description="code",
     *          example="12345",
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

    public function checkUserCode(CheckCodeRequest $request)
    {
        $info = $this->userService->checkUserCode($request['mobile'], $request['code']);

        return $this->successJsonResponse([
            'token' => $info['token'],
            'user' => $info['user']
        ]);
    }



    /**
     * complete User Profile
     *
     */
    public function createOrUpdateUserData(CreateUserRequest $request)
    {
        $user = auth('sanctum')->user();
        if($user['status'] != 0){
            return $this->errorResponse($user, 'you cant edit anymore');
        }
        $user = $this->userService->createOrUpdateUserData($user, $request);
        return $this->successJsonResponse($user);
    }



    /**
     * update the specified user 
     *
     */
    public function updateUserBio(UpdateUserRequest $request)
    {
        $userId = auth('sanctum')->id();
        $user = $this->userService->createOrUpdateUserData($userId, $request);
        return $this->successJsonResponse($user);
    }

    /**
     * forget password 
     *
     */
    public function forgetPassword(RegisterUserRequest $request)
    {
        
        $user = $this->userService->forgetPassword($request['mobile']);

        if(! $user){
            $this->errorResponse([], 'user with this mobile number doesnt exist');
        }
        return $this->successJsonResponse();
    }


    /**
     * reset password 
     *
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $userId = auth('sanctum')->id();
        $this->userService->resetPassword($userId, $request['password']);
        return $this->successJsonResponse();
    }



    /**
     * change password 
     *
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $userId = auth('sanctum')->id();
        $this->userService->changePassword($userId, $request['old_password'], $request['new_password']);
        return $this->successJsonResponse();
    }



    /**
     * delete user temporarily 
     *
     */
    public function temporaryDeleteUser(User $user)
    {
        $this->userService->deleteItem($user['id']);
        return $this->successJsonResponse();
    }



    /**
     * delete user permanently 
     *
     */
    public function permanentDeleteUser(User $user)
    {
        $this->userService->deleteItem($user['id']);
        return $this->successJsonResponse();
    }


}
