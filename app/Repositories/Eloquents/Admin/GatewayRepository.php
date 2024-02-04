<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\Gateway;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\GatewayRepositoryInterface;

class GatewayRepository extends BaseRepository implements GatewayRepositoryInterface
{
    public function __construct(Gateway $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }


    public function getGateway($name)
    {
        return $this->model->where('name', $name)->first();
    }

    
}