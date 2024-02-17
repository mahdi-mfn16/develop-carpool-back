<?php

namespace App\Services\User;

use App\Events\ChatMessageEvent;
use App\Repositories\Interfaces\Admin\StaticMessageRepositoryInterface;
use App\Repositories\Interfaces\User\ChatRepositoryInterface;
use App\Repositories\Interfaces\User\MessageRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Log;

class MessageService extends BaseService
{
    public function __construct(
        MessageRepositoryInterface $messageRepo,
        private ChatRepositoryInterface $chatRepo,
        private UserRepositoryInterface $userRepo
    )
    {
        parent::__construct($messageRepo);
    }


    public function getChatMessages($chatId, $request)
    {
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getChatMessages($chatId, $limit);
    }




    public function sendMessage($request, $chat)
    {
        $userId = auth('sanctum')->id();
        $message = $request->input('message');
        $message = $this->repository->sendMessage($userId, $message, $chat);
        
        event(new ChatMessageEvent('create', $message));

        return $message;
 
    }


    public function updateMessage($request, $message)
    {
        $newMessageText = $request->input('message');
        $message = $this->repository->updateMessage($message, $newMessageText);
        
        event(new ChatMessageEvent('update', $message));
        
        return $message;
   
    }



    public function deleteMessage($message)
    {
        $deletedMessage = clone $message;
        $this->deleteItem($message['id']);
       
        event(new ChatMessageEvent('delete', $deletedMessage));
        
        return [];
        
    }

     
}