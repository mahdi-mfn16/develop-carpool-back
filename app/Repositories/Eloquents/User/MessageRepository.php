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
        
    }

    public function getChatAllMessages($chatId)
    {
        $messages = $this->model
        ->where('chat_unique_id', $chatId)
        ->selectRaw("
            id,
            from_user_id,
            to_user_id,
            message,
            is_read,
            DATE_FORMAT(updated_at, '%H:%i') as time,
            DATE_FORMAT(updated_at, '%Y-%m-%d') as date
        ")
        ->orderBy('updated_at','asc')
        ->get();

        return $messages->groupBy('date')->values();
    }



    public function sendMessage($userId, $otherUserId, $message, $chat)
    {
        return $newMessage = $this->model->create([
            'chat_unique_id' => $chat['chat_unique_id'],
            'from_user_id' => $userId,
            'to_user_id' => $otherUserId,
            'message' => $message,
            'is_read' => 0
        ]);

        // return $this->model
        // ->where('id', $newMessage['id'])
        // ->selectRaw("
        //     id,
        //     from_user_id,
        //     to_user_id,
        //     message,
        //     is_read,
        //     DATE_FORMAT(updated_at, '%H:%i') as date
        // ")
        // ->first();

        return $this->getChatAllMessages($chat['chat_unique_id']);
    }


    public function updateMessage($messageId, $newMessage)
    {
        $message = $this->model->where('id', $messageId)->first();

        $message->update([
            'message' => $newMessage
        ]);

        return $message;

        return $this->getChatAllMessages($message['chat_unique_id']);
    }





    
}