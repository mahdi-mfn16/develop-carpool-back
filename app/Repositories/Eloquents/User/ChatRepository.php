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
        return [
            'messages',
            'user' => function($q){
                $q->with('files');
            },
            'rideApply' => function($q){
                $q->with(['ride' => function($q1){ 
                    $q1->with(['origin', 'destination']);
                }]);
            },
        ];
    }


    public function getChatList($userId, $limit = 10)
    {
        $load = [
            'user' => function($q){
                $q->with('files');
            },
            'rideApply' => function($q){
                $q->with(['ride' => function($q1){ 
                    $q1->with(['origin', 'destination']);
                }]);
            },
        ];

        $chats = $this->model
            ->where(function($q) use($userId){
                $q->where('user_id_one', $userId)
                ->orWhere('user_id_two', $userId);
            })
            ->with($load)
            ->paginate($limit);

        return $chats;
    }


    
}