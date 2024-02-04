<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\ChatMessageIndexRequest;
use App\Http\Requests\Message\SendDefaultMessageRequest;
use App\Http\Requests\Message\SendMessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Http\Requests\Message\UserMessageIndexRequest;
use App\Models\Chat;
use App\Models\Message;
use App\Services\User\ChatService;
use App\Services\User\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{

    public function __construct(
        private MessageService $messageService,
        private ChatService $chatService
    ){}






  /**
     * @OA\Get(
     *      path="/api/messages/{chatId}",
     *      operationId="getChatAllMessages",
     *      tags={"Message"},
     *      summary="get list of all messages for one chat ",
     *      description="get list of all messages for one chat",
     *      security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *         name="chatId",
     *         description="chat_id",
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
    public function getChatAllMessages(Chat $chat)
    {
        $chat = $this->chatService->getChatRecord($chat['id']);
        
        // Gate::authorize('viewAll', [Message::class, $chat]);
        
        $messages = $this->messageService->getChatAllMessages($chat['id']);
        return $this->successArrayResponse($messages);
    }



    /**
     * @OA\Get(
     *      path="/api/messages",
     *      operationId="getUserChatAllMessages",
     *      tags={"Message"},
     *      summary="get list of all messages for one chat ",
     *      description="get list of all messages for one chat",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="user_id",
     *         description="user_id",
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
    public function getUserAllMessages(UserMessageIndexRequest $request)
    {
        $userId = auth('sanctum')->id();
        $otherUserId = $request['user_id'];
        // $chat = $this->chatService->getUserChatRecord($userId, $otherUserId);
        
        // Gate::authorize('viewAll', [Message::class, $chat]);

        $messages = $this->messageService->getUserAllMessages($userId, $otherUserId);
        return $this->successArrayResponse($messages);
    }





      /**
     * @OA\Post(
     *      path="/api/messages/send",
     *      operationId="sendMessage",
     *      tags={"Message"},
     *      summary="send a message to one user ",
     *      description="send a message to one user",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="user_id",
     *          description="user_id",
     *          example=1,
     *          @OA\Schema(type="integer")
     *          ),
     *      @OA\Property(
     *          property="message",
     *          description="message",
     *          example=1,
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
    public function sendMessage(SendMessageRequest $request)
    {
        // policy for vip user
        $userId = auth('sanctum')->id();
        $messages = $this->messageService->sendMessage($userId, $request);
        return $this->successArrayResponse($messages);
    }



    /**
     * @OA\Put(
     *      path="/api/messages/update/{messageId}",
     *      operationId="updateMessage",
     *      tags={"Message"},
     *      summary="update and edit one message",
     *      description="update and edit one message",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="message",
     *          description="message",
     *          example=1,
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
    public function updateMessage(UpdateMessageRequest $request, Message $message)
    {
        // Gate::authorize('update', $message);
        $newMessage = $request['message'];
        $messages = $this->messageService->updateMessage($message['id'], $newMessage);
        return $this->successArrayResponse($messages);
    }




 
    /**
     * @OA\Delete(
     *      path="/api/messages/delete/{messageId}",
     *      operationId="deleteMessage",
     *      tags={"Message"},
     *      summary="remove one message",
     *      description="remove one message",
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
    public function deleteMessage(Message $message)
    {
        // Gate::authorize('delete', $message);
        $messages = $this->messageService->deleteMessage($message);
        return $this->successArrayResponse($messages);
    }
}
