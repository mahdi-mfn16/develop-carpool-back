<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\Vehicle;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\VehicleRepositoryInterface;

class VehicleRepository extends BaseRepository implements VehicleRepositoryInterface
{
    public function __construct(Vehicle $model)
    {
        parent::__construct($model);
    }


    public function load()
    {
        
    }


 

    
}