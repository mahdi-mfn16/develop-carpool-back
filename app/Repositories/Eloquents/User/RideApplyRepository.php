<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\RideApply;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\RideApplyRepositoryInterface;

class RideApplyRepository extends BaseRepository implements RideApplyRepositoryInterface
{
    public function __construct(RideApply $model)
    {
        parent::__construct($model);
    }


    public function load()
    {
        return [
            'ride', 
            'user' => function($q){
            $q->with(['files']);
             }
        ];
    }



    public function getRideApplyList($limit, $filters)
    {
        $load = ['ride', 'user' => function($q){
            $q->with(['files']);
        }];

        $status = (isset($filters['status']) && $filters['status']) ? $filters['status'] : null;
        $rideId = (isset($filters['ride_id']) && $filters['ride_id']) ? $filters['ride_id'] : null;
   
        $applies = $this->model->query();
            
        if($status){
            $applies = $applies->where('status', $status);
        }
        
        if($rideId){
            $applies = $applies->where('ride_id', $rideId);
        }
        $applies = $applies->with($load)->paginate($limit);

        return $applies;
        
    }


    

    
}