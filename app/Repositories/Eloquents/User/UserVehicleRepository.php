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


    public function getUserVehicles($filters, $limit = 10)
    {
        $load = [
            'vehicle',
            'files'
        ];
        $vehicles = $this->model->query();
        $userId = (isset($filters['user_id']) && $filters['user_id']) ? $filters['user_id'] : null;
        if($userId){
            $vehicles = $vehicles->where('user_id', $userId);
        }

        $vehicles = $vehicles
            ->with($load)
            ->paginate($limit);

        return $vehicles;
    }



    public function createUserVehicle($userId, $request)
    {
        return $this->model->create([
            'user_id' => $userId,
            'vehicle_id' => $request->input('vehicle_id'),
            'plate_number' => $request->input('plate_number'),
            'year_model' => $request->input('year_model'),
            'color' => $request->input('color'),
            'status' => 0,
        ]);
    }


    public function updateUserVehicle($vehicle, $request)
    {
        return $vehicle->update([
            'vehicle_id' => $request->input('vehicle_id'),
            'plate_number' => $request->input('plate_number'),
            'year_model' => $request->input('year_model'),
            'color' => $request->input('color'),
        ]);
    }


    

    
}