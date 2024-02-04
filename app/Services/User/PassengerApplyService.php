<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\PassengerApplyRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Log;

class PassengerApplyService extends BaseService
{
    public function __construct(
        PassengerApplyRepositoryInterface $passengerApplyRepo
    )
    {
        parent::__construct($passengerApplyRepo);
    }


   
    
}