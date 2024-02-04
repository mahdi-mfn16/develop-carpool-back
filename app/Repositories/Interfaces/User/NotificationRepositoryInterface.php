<?php

namespace App\Repositories\Interfaces\User;


interface NotificationRepositoryInterface
{
    public function getUserNofications($userId);
    public function createNotification($userId, $type, $params = [], $message = null);
}