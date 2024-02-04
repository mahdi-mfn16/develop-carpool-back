<?php

namespace App\Repositories\Interfaces\User;


interface MessageRepositoryInterface
{
    public function getChatAllMessages($chatId);
    public function sendMessage($userId, $otherUserId, $message, $chat);
    public function updateMessage($messageId, $newMessage);
}