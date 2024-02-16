<?php

namespace App\Repositories\Interfaces\User;


interface ChatRepositoryInterface
{
    public function create($params);
    public function getChatList($userId, $limit);

}