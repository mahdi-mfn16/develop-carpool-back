<?php

namespace App\Services\Admin;

use App\Repositories\Eloquents\Admin\CityRepository;
use App\Services\BaseService;

class CityService extends BaseService
{
    public function __construct(
        CityRepository $cityRepo
    )
    {
        parent::__construct($cityRepo);
    }


    public function getCities($provinceId = null)
    {
        $this->repository->getCities($provinceId);
    }

    
}