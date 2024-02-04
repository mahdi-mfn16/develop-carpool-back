<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\RateRepositoryInterface;
use App\Services\BaseService;

class RateService extends BaseService
{
    public function __construct(
        RateRepositoryInterface $rateRepo
    )
    {
        parent::__construct($rateRepo);
    }



    
    

    
}