<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportType\IndexReportTypeRequest;
use App\Http\Requests\ReportType\StoreReportTypeRequest;
use App\Http\Requests\ReportType\UpdateReportTypeRequest;
use App\Models\ReportType;
use App\Services\Admin\ReportTypeService;
use Illuminate\Http\Request;

class ReportTypeController extends Controller
{
    /**
     * @OA\Tag( name="Admin - Report Type", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private ReportTypeService $reportTypeService
    ){}


    /**
     * @OA\Get(
     *      path="/api/admin/reports/type",
     *      operationId="getAdminProvinces",
     *      tags={"Admin - Province"},
     *      summary="get list of provinces",
     *      description="get list of provinces",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexReportTypeRequest $request)
    {
        $types = $this->reportTypeService->indexAllItems();
        return $this->successArrayResponse($types);
        
    }



    /**
     * Store a newly created report type in storage.
     *
     */
    public function store(StoreReportTypeRequest $request)
    {
        $type = $this->reportTypeService->createItem($request->all());
        return $this->successJsonResponse($type);
    }

    /**
     * Display the specified report type.
     *
     */
    public function show(ReportType $reportType)
    {
        $type = $this->reportTypeService->showItem($reportType['id']);
        return $this->successJsonResponse($type);
    }



    /**
     * Update the specified report type in storage.
     *
     */
    public function update(UpdateReportTypeRequest $request, ReportType $reportType)
    {
        $type = $this->reportTypeService->updateItem($reportType['id'], $request->all());
        return $this->successJsonResponse($type);
    }

    /**
     * Remove the specified report type from storage.
     *
     */
    public function destroy(ReportType $reportType)
    {
        $this->reportTypeService->deleteItem($reportType['id']);
        return $this->successJsonResponse();
    }
}
