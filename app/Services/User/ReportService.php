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


    public function getReportingUsers($userId)
    {
        return $this->repository->getReportingUsers($userId);
    }



    public function getReportedUsers($userId)
    {
        return $this->repository->getReportedUsers($userId);

    }

 

    public function reportUser($userId, $request)
    {
        $reportTypeId = $request['report_type_id'];
        $reportText = $request['report_text'];
        $reportedUserId = $request['reported_user_id'];
        return $this->repository->reportUser($userId, $reportedUserId, $reportTypeId, $reportText);
    }


     
}