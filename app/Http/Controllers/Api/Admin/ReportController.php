<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\IndexReportRequest;
use App\Http\Requests\Report\UserReportRequest;
use App\Http\Resources\Report\ReportCollection;
use App\Services\User\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function __construct(
        private ReportService $reportService
    )
    {}
    

  
    public function getAllReports(IndexReportRequest $request)
    {
        $reports = $this->reportService->getAllReports($request);
        return $this->successPaginateResponse(new ReportCollection($reports));
    }




}
