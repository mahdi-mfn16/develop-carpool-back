<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\ReportRepositoryInterface;
use App\Services\BaseService;

class ReportService extends BaseService
{
    public function __construct(
        ReportRepositoryInterface $reportRepo
    )
    {
        parent::__construct($reportRepo);
    }


    public function getAllReports($request)
    {
        $limit = $request->input('limit') ?: 10;
        $filters = $request->input('filters');
        return $this->repository->getAllReports($filters, $limit);
    }



    public function reportUser($userId, $request)
    {
        $reportTypeId = $request['report_type_id'];
        $reportText = $request['text'];
        $reportedUserId = $request['reported_user_id'];
        return $this->repository->reportUser($userId, $reportedUserId, $reportTypeId, $reportText);
    }


     
}