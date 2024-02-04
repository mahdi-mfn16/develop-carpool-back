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

    
}