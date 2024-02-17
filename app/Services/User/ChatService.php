<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\ChatRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;

use function PHPUnit\Framework\returnSelf;

class ChatService extends BaseService
{
    public function __construct(
        ChatRepositoryInterface $chatRepo,
        private UserRepositoryInterface $userRepo,
    )
    {
        parent::__construct($chatRepo);
    }



    public function getUserChatList($userId, $request)
    {
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getUserChatList($userId, $limit);
    }


    public function showOneUserChat($userId, $otherUserId)
    {       
        $chat = $this->repository->getOneUserChat($userId, $otherUserId);
        return $chat;
        // $user = $this->userRepo->getUserChatInfo($otherUserId);
        // return ['chat'=> $chat, 'user' => $user];

    }



    public function getChatRecord($chatId)
    {
        return $this->repository->getChatRecord($chatId);
        // $otherUserId = $chat['user_id_one'] == $userId ? $chat['user_id_two'] : $chat['user_id_one'];
        // $user = $this->userRepo->getUserChatInfo($otherUserId);
        // return ['chat'=> $chat, 'user' => $user];
    }


    public function getOneChat($chatId)
    {
        return $this->repository->getOneChat($chatId);
    }



     
}