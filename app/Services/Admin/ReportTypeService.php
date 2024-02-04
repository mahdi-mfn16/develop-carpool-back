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

    
}