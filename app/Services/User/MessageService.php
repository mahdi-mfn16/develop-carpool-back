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


    public function getChatAllMessages($chatId)
    {
        return $this->repository->getChatAllMessages($chatId);
    }




    public function getUserAllMessages($userId, $otherUserId)
    {
        $chat = $this->chatRepo->getOneUserChat($userId, $otherUserId);
        return $this->repository->getChatAllMessages($chat['chat_unique_id']);
    }




    public function sendMessage($userId, $request)
    {
        $otherUserId = $request['user_id'];
        $message = $request['message'];
        $chat = $this->chatRepo->getOrCreateChat($userId, $otherUserId);
        $message = $this->repository->sendMessage($userId, $otherUserId, $message, $chat);
        event(new ChatMessageEvent('create', $message));
        return $message;
        // $messages = $this->repository->getChatAllMessages($message['chat_unique_id']);
        // return $messages;
    }


    public function updateMessage($messageId, $newMessage)
    {
        $message = $this->repository->updateMessage($messageId, $newMessage);
        event(new ChatMessageEvent('update', $message));
        return $message;
        // $messages = $this->repository->getChatAllMessages($message['chat_unique_id']);
        // return $messages;
    }



    public function deleteMessage($message)
    {
        $deletedMessage = clone $message;
        $this->deleteItem($message['id']);
       
        event(new ChatMessageEvent('delete', $deletedMessage));
        return [];
        // $messages = $this->getChatAllMessages($message['chat_unique_id']);
        // return $messages;
    }

     
}