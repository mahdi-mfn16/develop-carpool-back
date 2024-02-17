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


    public function getPreferenceOptions($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getPreferenceOptions($filters, $limit);
    }



}