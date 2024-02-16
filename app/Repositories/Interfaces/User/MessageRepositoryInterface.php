<?php

namespace App\Repositories\Interfaces\User;


interface MessageRepositoryInterface
{
    public function getChatMessages($chatId, $limit);
    public function sendMessage($userId, $message, $chat);
    public function updateMessage($message, $newMessageText);
}