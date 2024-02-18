<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Ride;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\RideRepositoryInterface;

class RideRepository extends BaseRepository implements RideRepositoryInterface
{
    public function __construct(Ride $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [];
    }


    public function getMyRides($limit)
    {
        $load = ['origin', 'destination'];
        return $this->model->where('user_id', auth('sanctum')->id())->with($load)->paginate($limit);
    }


    public function getAllRides($limit, $filters)
    {
        $load = ['origin', 'destination', 'user' => function($q){
            $q->with(['profile']);
        }];

        $sub = $this->model->where('origin_city_id', $filters['origin'])
            ->where('destination_city_id', $filters['destination'])
            ->where('date', $filters['date'])
            ->selectRaw('id, (capacity - booked) as empty');
        
        $rides = $this->model->where('rides.origin_city_id', $filters['origin'])
            ->where('rides.destination_city_id', $filters['destination'])
            ->where('rides.date', $filters['date'])
            ->joinSub($sub, 'sub', function($q) use($filters){
                $q->on('sub.id', '=', 'rides.id');
                $q->where('sub.empty', '>=', $filters['capacity']);
            });

        if($filters['gender']){
            $rides = $rides->whereHas('user', function($q) use($filters){
                $q->where('gender', $filters['gender']);
            });
        }
        $rides = $rides->with($load)->paginate($limit);

        return $rides;
    }



    public function getAdminRideList($limit, $filters)
    {
        $load = ['origin', 'destination', 'user' => function($q){
            $q->with(['profile']);
        }];

        $origin = (isset($filters['origin']) && $filters['origin']) ? $filters['origin'] : null;
        $destination = (isset($filters['destination']) && $filters['destination']) ? $filters['destination'] : null;
        $userId = (isset($filters['user_id']) && $filters['user_id']) ? $filters['user_id'] : null;
   
        $rides = $this->model->query();
            
        if($origin){
            $rides = $rides->where('origin_city_id', $origin);
        }
        if($destination){
            $rides = $rides->where('destination_city_id', $destination);
        }
        if($userId){
            $rides = $rides->where('user_id', $userId);
        }
        $rides = $rides->with($load)->paginate($limit);

        return $rides;
    }


    


    

    
}