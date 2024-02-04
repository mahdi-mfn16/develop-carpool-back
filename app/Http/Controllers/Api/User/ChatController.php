<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatIndexRequest;
use App\Http\Requests\Chat\ChatUserIndexRequest;
use App\Models\Chat;
use App\Services\User\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{

    public function __construct(
        private ChatService $chatService
    ){}

       /**
     * @OA\Tag(
     *      name="Chat",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */




     /**
     * @OA\Get(
     *      path="/api/chats",
     *      operationId="getUserChatList",
     *      tags={"Chat"},
     *      summary="get list of all chats for one user",
     *      description="get list of all chats for one user",
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

    public function getUserChatList()
    {
        $userId = auth('sanctum')->id();
        $chats = $this->chatService->getUserChatList($userId);
        return $this->successArrayResponse($chats);
    }



    /**
     * @OA\Post(
     *      path="/api/chats/user-chat",
     *      operationId="showOneUserChat",
     *      tags={"Chat"},
     *      summary="show one user chat base on user_id",
     *      description="show one user chat base on user_id",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="user_id",
     *          description="user_id",
     *          example=1,
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

    public function showOneUserChat(ChatUserIndexRequest $request)
    {
        $userId = auth('sanctum')->id();
        $otherUserId = $request['user_id'];

        $chatInfo = $this->chatService->showOneUserChat($userId, $otherUserId);

        return $this->successJsonResponse($chatInfo);

    }




     /**
     * @OA\Post(
     *      path="/api/chats/{chat}",
     *      operationId="showOneChat",
     *      tags={"Chat"},
     *      summary="show one specific chat base on chat unique id",
     *      description="show one specific chat base on chat unique id",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="chat_unique_id",
     *          description="chat_unique_id",
     *          example="43dfg",
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
    public function showOneChat(ChatIndexRequest $request, Chat $chat)
    {
        $userId = auth('sanctum')->id();
        $chatId = $request['chat_unique_id'];

        Gate::authorize('view', $chat);

        $chat = $this->chatService->getOneChat($chatId);

        // $chatInfo = $this->chatService->showOneChat($userId, $chat);

        return $this->successJsonResponse($chat);
    }




      /**
     * @OA\Delete(
     *      path="/api/chats/{chat}",
     *      operationId="deleteChat",
     *      tags={"Chat"},
     *      summary="remove one chat",
     *      description="remove one chat",
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

    public function deleteChat(Chat $chat)
    {
        Gate::authorize('delete', $chat);
        
        $this->chatService->deleteItem($chat['id']);
        return $this->successJsonResponse();
    }
}
