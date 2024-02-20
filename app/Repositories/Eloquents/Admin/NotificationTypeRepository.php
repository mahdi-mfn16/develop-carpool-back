<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\NotificationType;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\NotificationTypeRepositoryInterface;

class NotificationTypeRepository extends BaseRepository implements NotificationTypeRepositoryInterface
{
    public function __construct(NotificationType $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [];    
    }


    public function getNotificationType($type)
    {
        return $this->model->where('name', $type)->first();
    }



    public function getNotificationTypes($filters, $limit = 10)
    {
        $notificationTypes = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';

        $notificationTypes = $notificationTypes->where('name', 'like', '%'.$search.'%')
        ->paginate($limit);

        return $notificationTypes;
    }

    
}