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
        
    }


    public function getNotificationType($type)
    {
        return $this->model->where('name', $type)->first();
    }

    
}