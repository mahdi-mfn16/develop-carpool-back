<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\UserVehicle;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\UserVehicleRepositoryInterface;

class UserVehicleRepository extends BaseRepository implements UserVehicleRepositoryInterface
{
    public function __construct(UserVehicle $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }


    

    
}