<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\UserReportRequest;
use App\Http\Resources\ReportType\ReportTypeResource;
use App\Services\Admin\ReportTypeService;
use App\Services\User\ReportService;
use Illuminate\Http\Request;

class ReportTypeController extends Controller
{


    public function __construct(
        private ReportTypeService $reportTypeService
    )
    {}
    

 
    /**
     * @OA\Get(
     *      path="/api/reports/types",
     *      operationId="getReportTypes",
     *      tags={"Report"},
     *      summary="get list of report types",
     *      description="get list of report types",
     *      security={{"bearer":{}}},  
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReportTypes()
    {
        $types = $this->reportTypeService->indexAllItems();
        return $this->successArrayResponse(ReportTypeResource::collection($types));
    }


}
