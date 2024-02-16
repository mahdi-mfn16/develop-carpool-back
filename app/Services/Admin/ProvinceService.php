<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\ProvinceRepositoryInterface;
use App\Services\BaseService;

class ProvinceService extends BaseService
{
    public function __construct(
        ProvinceRepositoryInterface $provinceRepo
    )
    {
        parent::__construct($provinceRepo);
    }


    public function getProvinces($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit');
        return $this->repository->getProvinces($filters, $limit);
    }
    
}