<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\IndexReportRequest;
use App\Http\Requests\Report\UserReportRequest;
use App\Http\Resources\Report\ReportCollection;
use App\Http\Resources\Report\ReportResource;
use App\Models\Report;
use App\Services\User\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function __construct(
        private ReportService $reportService
    )
    {}
    

     /**
     * @OA\Get(
     *      path="/api/admin/reports",
     *      operationId="getAdminReport",
     *      tags={"Admin - Report"},
     *      summary="get list of reports",
     *      description="get list of reports",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Parameter( name="filters[reported_user_id]", in="query", description="reported user id", @OA\Schema( type="integer", example="" ) ),
     *      @OA\Parameter( name="filters[report_type_id]", in="query", description="report type id", @OA\Schema( type="integer", example="" ) ),     
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllReports(IndexReportRequest $request)
    {
        $reports = $this->reportService->getAllReports($request);
        return $this->successPaginateResponse(new ReportCollection($reports));
    }




    /**
     * @OA\Get(
     *      path="/api/admin/reports/{reportId}",
     *      operationId="showAdminReports",
     *      tags={"Admin - Reports"},
     *      summary="show one report",
     *      description="show one report",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reportId", description="report id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Report $report)
    {
        $report = $this->reportService->showItem($report['id']);
        return $this->successJsonResponse(ReportResource::make($report));
    }




    /**
     * @OA\Delete(
     *      path="/api/admin/reports/{reportId}",
     *      operationId="destroyAdminReport",
     *      tags={"Admin - Reports"},
     *      summary="destroy one report",
     *      description="destroy one report",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reportId", description="report id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Report $report)
    {
        $this->reportService->deleteItem($report['id']);
        return $this->successJsonResponse();
    }




}
