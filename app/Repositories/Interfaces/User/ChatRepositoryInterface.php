<?php

namespace App\Repositories\Interfaces\User;


interface ChatRepositoryInterface
{
    public function create($params);
    public function getUserChatList($userId);
    public function getOneChat($chatId);
    public function getOneUserChat($userId, $otherUserId);
    public function getOrCreateChat($userId, $otherUserId);
    public function getChatRecord($chatId);
}