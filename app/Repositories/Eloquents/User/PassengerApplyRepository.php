<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\PassengerApply;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\PassengerApplyRepositoryInterface;

class PassengerApplyRepository extends BaseRepository implements PassengerApplyRepositoryInterface
{
    public function __construct(PassengerApply $model)
    {
        parent::__construct($model);
    }


    public function load()
    {
        
    }


    

    
}