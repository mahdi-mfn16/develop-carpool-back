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
        return ['notificationType'];
    }


    public function getUserNofications($userId)
    {
        return $this->model->where('user_id', $userId)
            ->with(['notificationType'])
            ->get();
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