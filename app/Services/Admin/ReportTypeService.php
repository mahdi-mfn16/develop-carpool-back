<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\ReportTypeRepositoryInterface;
use App\Services\BaseService;

class ReportTypeService extends BaseService
{
    public function __construct(
        ReportTypeRepositoryInterface $reportTypeRepo
    )
    {
        parent::__construct($reportTypeRepo);
    }


    public function getReportTypes($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit');
        return $this->repository->getReportTypes($filters, $limit);
    }

    
}