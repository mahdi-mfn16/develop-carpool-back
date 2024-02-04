<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\PreferenceOptionRepositoryInterface;
use App\Services\BaseService;

class PreferenceOptionService extends BaseService
{
    public function __construct(
        PreferenceOptionRepositoryInterface $preferenceOptionRepo
    )
    {
        parent::__construct($preferenceOptionRepo);
    }



}