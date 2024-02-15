<?php 

namespace App\Repositories\Eloquents\User;

use App\Helpers\Helper;
use App\Models\Chat;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\ChatRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }


    public function getUserChatList($userId)
    {
        $string = "(case when user_id_one = ".$userId." then user_id_two else user_id_one end) as user_id";

        $sub = $this->model->selectRaw("
        id,
        chat_unique_id,
        ".$string
        );


        $chats = $this->model
        ->whereRaw(
            'chats.user_id_one = '.$userId.' or chats.user_id_two = '.$userId     
        )
        ->joinSub($sub, 'sub', function($q){
            $q->on('sub.chat_unique_id', '=', 'chats.chat_unique_id');
        })
        ->join('users', 'users.id', '=', 'sub.user_id')
        ->leftJoin('images', function($q1){
            $q1->on('images.user_id', '=', 'users.id');
            $q1->where('images.is_profile', 1);
        })
        ->with(['messages' => function($q){
            $q->orderBy('created_at', 'desc');
        }])
        ->selectRaw("
        sub.user_id,
        users.first_name,
        users.last_name,
        images.name as image_name,
        images.url,
        images.is_profile,
        chats.chat_unique_id
        ")  
        ->orderBy('chats.updated_at', 'desc')
        ->get();

        $chats = $chats->sortByDesc(function($chat){
            return $chat['messages'][0]['updated_at'];
        });

        return $chats;
    }



    public function getOneChat($chatId)
    {
        $userId = auth('sanctum')->id();
        $string = "(case when user_id_one = ".$userId." then user_id_two else user_id_one end) as user_id";

        $sub = $this->model->selectRaw("
        id,
        chat_unique_id,
        ".$string
        );

        $chat = $this->model->where('chats.chat_unique_id', $chatId)
        ->joinSub($sub, 'sub', function($q){
            $q->on('sub.chat_unique_id', '=', 'chats.chat_unique_id');
        })
        ->join('users', 'users.id', '=', 'sub.user_id')
        ->join('images', function($q1){
            $q1->on('images.user_id', '=', 'users.id');
            $q1->where('images.is_profile', 1);
        })
        ->selectRaw("
        sub.user_id,
        users.first_name,
        users.last_name,
        images.name,
        images.url,
        images.is_profile,
        chats.chat_unique_id
        ")   
        ->first();

        return $chat;
    }



    public function getOneUserChat($userId, $otherUserId)
    {
        $string = "(case when user_id_one = ".$userId." then user_id_two else user_id_one end) as user_id";

        $sub = $this->model->selectRaw("
        id,
        chat_unique_id,
        ".$string
        );

        $chat = $this->model
        ->whereRaw(
            '(chats.user_id_one = '.$userId.' and chats.user_id_two = '.$otherUserId.') 
            or 
            (chats.user_id_one = '.$otherUserId.' and chats.user_id_two = '.$userId.')'
        )
        ->joinSub($sub, 'sub', function($q){
            $q->on('sub.chat_unique_id', '=', 'chats.chat_unique_id');
        })
        ->join('users', 'users.id', '=', 'sub.user_id')
        ->selectRaw("
        sub.user_id,
        users.first_name,
        users.last_name,
        chats.chat_unique_id
        ") 
        ->first();

        return $chat;
    }



    public function getOrCreateChat($userId, $otherUserId)
    {
        $chat = $this->getOneUserChat($userId, $otherUserId);
        if(! $chat){
            $chat = $this->model->create([
                'user_id_one' => $userId,
                'user_id_two' => $otherUserId,
                'ride_apply_id' => Helper::generateChatUniqueId(),
            ]);

            $chat = $this->getOneUserChat($userId, $otherUserId);

        }

        return $chat;
    }


    public function getChatRecord($chatId)
    {
        return $this->model->where('chat_unique_id', $chatId)->first();
    }


    public function getUserChatRecord($userId , $otherUserId)
    {
        return $this->model->whereRaw('
                (user_id_one = '.$userId.' and user_id_two = '.$otherUserId.') 
                or 
                (user_id_one = '.$otherUserId.' and user_id_two = '.$userId.')
            ')->first();
    }


    
}