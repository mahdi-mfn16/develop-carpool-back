<?php 

namespace App\Repositories\Eloquents\User;

use App\Helpers\Helper;
use App\Models\Ride;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\RideRepositoryInterface;
use Illuminate\Support\Carbon;

class RideRepository extends BaseRepository implements RideRepositoryInterface
{
    public function __construct(Ride $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [
            'direction', 
            'origin', 
            'destination', 
            'userVehicle' => function($q){
                $q->with(['vehicle']);
            }
        ];
    }


    public function getMyRides($limit)
    {
        $load = ['origin', 'destination'];
        return $this->model->where('user_id', auth('sanctum')->id())->with($load)->paginate($limit);
    }


    public function getAllRides($limit, $filters)
    {
        $load = ['origin', 'destination', 'user' => function($q){
            $q->with(['files']);
        }];


        
        $rides = $this->model->where('rides.origin_city_id', $filters['origin'])
            ->where('rides.destination_city_id', $filters['destination'])
            ->where('rides.date', $filters['date'])
            ->where('rides.type', $filters['type'])
            ->where('status', config('setting.ride_status.active'));
        if($filters['type'] == 'rider'){
            $rides = $rides->whereRaw("(capacity - booked) >= ". $filters['capacity']."");
        }else{ // passenger
            $rides = $rides->whereRaw("(capacity - booked) > 0 and (capacity - booked) <= ". $filters['capacity']."");
        }
           


        if(isset($filters['gender']) && !is_null($filters['gender'])){
            $rides = $rides->whereHas('user', function($q) use($filters){
                $q->where('gender', $filters['gender']);
            });
        }
        if($filters['type']){
            $rides = $rides->where('type', $filters['type']);
        }
        $rides = $rides->with($load)->paginate($limit);

        return $rides;
    }



    public function getAdminRideList($limit, $filters)
    {
        $load = ['origin', 'destination', 'user' => function($q){
            $q->with(['files']);
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


    public function checkSameRideExist($date, $startTime)
    {
        $startTimeRange = Carbon::parse($startTime)->addMinutes(-15);
        $endTimeRange = Carbon::parse($startTime)->addMinutes(15);
        $startTime = Carbon::parse($startTime);
        $ride = $this->model->where('user_id', auth('sanctum')->id())
        ->where('date', Carbon::parse($date))
        ->whereRaw('(start_time <= "'.$endTimeRange.'" and start_time >= "'.$startTimeRange.'") or end_time >= "'.$startTime.'"')
        ->first();

        return $ride ? true : false;
            
    }


    

    public function createRide($request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $direction = $request->input('direction');
        $endTime = Helper::getLastDurationTime($request->input('start_time'), $direction['time']);
 
        return $this->model->create([
            'user_id' => auth('sanctum')->id(),
            'origin_city_id' => $origin['city_id'],
            'origin_lat' => $origin['lat'],
            'origin_lng' => $origin['lng'],
            'origin_address' => $origin['name'],
            'destination_city_id' => $destination['city_id'],
            'destination_lat' => $destination['lat'],
            'destination_lng' => $destination['lng'],
            'destination_address' => $destination['name'],
            'user_vehicle_id' => $request->input('user_vehicle_id'),
            'capacity' => $request->input('capacity'),
            'booked' => 0,
            'date' => $request->input('date'),
            'distance' => $direction['distance'],
            'start_time' => $request->input('start_time'),
            'end_time' => $endTime,
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'fee' => 0,
            'status' => config('setting.ride_status.active'),
        ]);
    }


    public function updateRide($ride, $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $direction = $request->input('direction');
        if($direction){
            $endTime = Helper::getLastDurationTime($request->input('start_time'), $direction['time']);
        }
        
        return $ride->update([

            'origin_city_id' => $origin ? $origin['city_id'] : $ride['origin_city_id'],
            'origin_lat' => $origin ? $origin['lat'] : $ride['origin_lat'],
            'origin_lng' => $origin ? $origin['lng'] : $ride['origin_lng'],
            'origin_address' => $origin ? $origin['name'] : $ride['origin_address'],
            'destination_city_id' => $destination ? $destination['city_id'] : $ride['destination_city_id'],
            'destination_lat' => $destination ? $destination['lat'] : $ride['destination_lat'],
            'destination_lng' => $destination ? $destination['lng'] : $ride['destination_lng'],
            'destination_address' => $destination ? $destination['name'] : $ride['destination_lng'],
            'user_vehicle_id' => isset($request['user_vehicle_id']) ? $request['user_vehicle_id'] : $ride['user_vehicle_id'], 
            'capacity' => isset($request['capacity']) ? $request['capacity'] : $ride['capacity'],
            'booked' => isset($request['booked']) ? $request['booked'] : 0,
            'date' => isset($request['date']) ? $request['date'] : $ride['date'],
            'distance' => $direction ? $direction['distance'] : $ride['distance'],
            'start_time' => isset($request['start_time']) ? $request['start_time'] : $ride['start_time'],
            'end_time' => $direction ? $endTime : $ride['end_time'],
            'type' => isset($request['type']) ? $request['type'] : $ride['type'],
            'description' => isset($request['description']) ? $request['description'] : $ride['description'],
            'price' => isset($request['price']) ? $request['price'] : $ride['price'],
            
        ]);
        
    }


    public function cancelRide($ride)
    {
        return $ride->update([
            'status' => config('setting.ride_status.canceled')
        ]);
    }


    

    
}