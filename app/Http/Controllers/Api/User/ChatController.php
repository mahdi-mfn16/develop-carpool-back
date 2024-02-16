<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatIndexRequest;
use App\Http\Requests\Chat\ChatUserIndexRequest;
use App\Http\Resources\Chat\ChatCollection;
use App\Http\Resources\Chat\ChatResource;
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
     *      operationId="getChatList",
     *      tags={"Chat"},
     *      summary="get list of all chats of user",
     *      description="get list of all chats of user",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="page",
     *         description="page",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Parameter(
     *         name="limit",
     *         description="limit",
     *         in = "query",
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

    public function getChatList(ChatIndexRequest $request)
    {
        $userId = auth('sanctum')->id();
        $chats = $this->chatService->getUserChatList($userId, $request);
        return $this->successPaginateResponse(new ChatCollection($chats));
    }



     /**
     * @OA\Get(
     *      path="/api/chats/{chatId}",
     *      operationId="showChat",
     *      tags={"Chat"},
     *      summary="show one specific chat",
     *      description="show one specific chat",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="chatId",
     *         description="chat id",
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
    public function showChat(Chat $chat)
    {
        Gate::authorize('view', $chat);
        $chat = $this->chatService->showItem($chat['id']);
        return $this->successJsonResponse(ChatResource::make($chat));
    }




      /**
     * @OA\Delete(
     *      path="/api/chats/{chatId}",
     *      operationId="deleteChat",
     *      tags={"Chat"},
     *      summary="remove one chat",
     *      description="remove one chat",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="chatId",
     *         description="chat id",
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

    public function deleteChat(Chat $chat)
    {
        // ride apply of chat must be closed or expired
        // Gate::authorize('delete', $chat);
        
        // $this->chatService->deleteItem($chat['id']);
        return $this->successJsonResponse(['text' => 'this API is coming soon']);
    }
}
