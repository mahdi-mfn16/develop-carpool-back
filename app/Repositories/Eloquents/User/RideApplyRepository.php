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
        
    }


    

    
}