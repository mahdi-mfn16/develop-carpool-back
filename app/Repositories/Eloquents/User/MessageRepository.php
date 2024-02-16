<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Message;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\MessageRepositoryInterface;
use Illuminate\Support\Facades\Log;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [];
    }

    public function getChatMessages($chatId, $limit = 10)
    {
        return $this->model
            ->where('chat_id', $chatId)
            ->orderBy('created_at','desc')
            ->paginage($limit);

    }



    public function sendMessage($userId, $message, $chat)
    {
        $otherUserId = ($userId == $chat->user_id_one) ? $chat->user_id_two : $chat->user_id_one;

        return  $this->model->create([
            'chat_id' => $chat['id'],
            'from_user_id' => $userId,
            'to_user_id' => $otherUserId,
            'message' => $message,
            'is_read' => 0
        ]);

   
    }


    public function updateMessage($message, $newMessageText)
    {

        $message->update([
            'message' => $newMessageText
        ]);

        return $this->find($message['id']);

    }





    
}