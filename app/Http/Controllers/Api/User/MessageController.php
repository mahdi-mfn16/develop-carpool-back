<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageIndexRequest;
use App\Http\Requests\Message\SendMessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Http\Requests\Message\UserMessageIndexRequest;
use App\Http\Resources\Message\MessageCollection;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use App\Services\User\ChatService;
use App\Services\User\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{

    /**
     * @OA\Tag(
     *      name="Message",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    public function __construct(
        private MessageService $messageService,
        private ChatService $chatService
    ){}






  /**
     * @OA\Get(
     *      path="/api/messages/{chatId}",
     *      operationId="getMessages",
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
    public function getMessages(MessageIndexRequest $request, Chat $chat)
    {
        Gate::authorize('viewAll', [Message::class, $chat]);
        $messages = $this->messageService->getChatMessages($chat['id'], $request);
        return $this->successPaginateResponse(new MessageCollection($messages));
    }



    /**
     * @OA\Post(
     *      path="/api/messages/send/{chatId}",
     *      operationId="sendMessage",
     *      tags={"Message"},
     *      summary="send a message in one chat ",
     *      description="send a message in one chat",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="chatId",
     *         description="chat_id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
    *       @OA\RequestBody(
    *       @OA\JsonContent(
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
    public function sendMessage(SendMessageRequest $request, Chat $chat)
    {
        Gate::authorize('create', [Message::class, $chat]);
        $message = $this->messageService->sendMessage($request, $chat);
        return $this->successJsonResponse(MessageResource::make($message));
    }



    /**
     * @OA\Put(
     *      path="/api/messages/update/{messageId}",
     *      operationId="updateMessage",
     *      tags={"Message"},
     *      summary="update and edit one message",
     *      description="update and edit one message",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="messageId",
     *         description="message id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\RequestBody(
     *      @OA\JsonContent(
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
        Gate::authorize('update', $message);
        $message = $this->messageService->updateMessage($request, $message);
        return $this->successJsonResponse(MessageResource::make($message));
    }




 
    /**
     * @OA\Delete(
     *      path="/api/messages/delete/{messageId}",
     *      operationId="deleteMessage",
     *      tags={"Message"},
     *      summary="remove one message",
     *      description="remove one message",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="messageId",
     *         description="message id",
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
    public function deleteMessage(Message $message)
    {
        Gate::authorize('delete', $message);
        $this->messageService->deleteMessage($message);
        return $this->successJsonResponse();
    }
}
