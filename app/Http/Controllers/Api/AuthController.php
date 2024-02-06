<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepo,
        private UserService $userService
    )
    {}

      /**
     * @OA\Tag(
     *      name="Auth",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */


     /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="login user",
     *      description="login user",
     *      security={
     *          {"bearer": {}},
     *      },
     *    @OA\RequestBody(
     *     required=true,
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="mobile",
     *          description="mobile",
     *          example="09156326123",
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

    public function login(LoginRequest $request)
    {
        // if( ! Auth::attempt(['mobile' => $request['mobile'], 'password' => $request['password']])){
        //     return $this->errorResponse([ 
        //         'token' => null,
        //         'user' => null
        //     ]); 
        // }
    

        // $token = $request->user()->createToken('authToken')->plainTextToken;

        // return $this->successJsonResponse([
        //     'token' => $token,
        //     'user' => $user
        // ]);

        $user = $this->userService->registerUser($request['mobile']);
        
        // $token = $user->createToken('authToken')->plainTextToken;
        // return $this->successJsonResponse(['user' => $user, 'token'=>$token]);

        return $this->successJsonResponse();
    }




    /**
     * @OA\Get(
     *      path="/api/auth/logout",
     *      operationId="logout",
     *      tags={"Auth"},
     *      summary="logout user",
     *      description="logout user",
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

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }
}
