<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\UserReportRequest;
use App\Services\User\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function __construct(
        private ReportService $reportService
    )
    {}
    

    /**
     * get list of users that auth user has been reported by them.
     *
     */
    public function getReportingUsers()
    {
        $userId = auth('sanctum')->id();
        $reportingUsers = $this->reportService->getReportingUsers($userId);
        return $this->successArrayResponse($reportingUsers);
    }



    /**
     * get list of users that auth user reported them.
     *
     */
    public function getReportedUsers()
    {
        $userId = auth('sanctum')->id();
        $reportedUsers = $this->reportService->getReportedUsers($userId);
        return $this->successArrayResponse($reportedUsers);

    }

 
    /**
     *  report one specific user id.
     *
     */
    public function reportUser(UserReportRequest $request)
    {
        $userId = auth('sanctum')->id();
        $reported = $this->reportService->reportUser($userId, $request);
        return $this->successJsonResponse();
    }


}
