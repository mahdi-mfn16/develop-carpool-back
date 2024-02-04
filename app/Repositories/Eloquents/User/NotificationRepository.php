<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Notification;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\NotificationRepositoryInterface;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }


    public function getUserNofications($userId)
    {
        return $this->model->where('notifications.user_id', $userId)
            ->join('notification_types', 'notification_types.id', '=', 'notifications.notification_type_id')
            ->selectRaw("
                notifications.user_id,
                notifications.message,
                notifications.created_at as notification_date,
                notification_types.id as notification_type_id,
                notification_types.name as notification_type,
                notification_types.text as notification_type_name
            ")->get();
    }




    public function createNotification($userId, $type, $params = [], $message = null)
    {
        $message = $message ?: __('notification.'.$type['name'], $params);
        return $this->model->create(
            [
                'user_id' => $userId,
                'message' => $message,
                'notification_type_id' => $type['id']
            ]
        );
    }


}