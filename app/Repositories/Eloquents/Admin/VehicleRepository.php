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
        return [];
    }



    public function getVehicles($filters, $limit = 10)
    {
        $vehicles = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';

        $vehicles = $vehicles->where('name', 'like', '%'.$search.'%')
        ->paginate($limit);

        return $vehicles;
    }


 

    
}