<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\PreferenceRepositoryInterface;
use App\Services\BaseService;

class PreferenceService extends BaseService
{
    public function __construct(
        PreferenceRepositoryInterface $preferenceRepo
    )
    {
        parent::__construct($preferenceRepo);
    }



}