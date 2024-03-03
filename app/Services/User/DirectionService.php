<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\DirectionRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Log;

class DirectionService extends BaseService
{
    public function __construct(
        DirectionRepositoryInterface $directionRepo
    )
    {
        parent::__construct($directionRepo);
    }


   
    
}