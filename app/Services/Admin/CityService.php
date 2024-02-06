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


    public function getCities($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit');
        return $this->repository->getCities($filters, $limit);
    }

    
}