<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportType\IndexReportTypeRequest;
use App\Http\Requests\ReportType\StoreReportTypeRequest;
use App\Http\Requests\ReportType\UpdateReportTypeRequest;
use App\Http\Resources\ReportType\ReportTypeCollection;
use App\Http\Resources\ReportType\ReportTypeResource;
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
     *      path="/api/admin/reports/types",
     *      operationId="getAdminReportTypes",
     *      tags={"Admin - Report Type"},
     *      summary="get list of report types",
     *      description="get list of report types",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Parameter( name="filters[parent_id]", in="query", description="parent id", @OA\Schema( type="integer", example="" ) ),     
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
        $types = $this->reportTypeService->getReportTypes($request);
        return $this->successPaginateResponse(new ReportTypeCollection($types));

    }



    /**
     * @OA\Post(
     *      path="/api/admin/reports/types",
     *      operationId="storeAdminReportTypes",
     *      tags={"Admin - Report Types"},
     *      summary="create one report type",
     *      description="create one report type",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *       @OA\Property(property="text", description="text", example="test", @OA\Schema(type="string") ),
     *       @OA\Property(property="parent_id", description="parent id", example="1", @OA\Schema(type="integer") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreReportTypeRequest $request)
    {
        $type = $this->reportTypeService->createItem($request->all());
        return $this->successJsonResponse(ReportTypeResource::make($type));
    }

    /**
     * @OA\Get(
     *      path="/api/admin/reports/types/{reportTypeId}",
     *      operationId="showAdminReportTypes",
     *      tags={"Admin - Report Types"},
     *      summary="show one report type",
     *      description="show one report type",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reportTypeId", description="report type id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ReportType $reportType)
    {
        $type = $this->reportTypeService->showItem($reportType['id']);
        return $this->successJsonResponse(ReportTypeResource::make($type));
    }



    /**
     * @OA\Post(
     *      path="/api/admin/reports/types/{reportTypeId}",
     *      operationId="updateAdminReportTypes",
     *      tags={"Admin - Report Types"},
     *      summary="update one report type",
     *      description="update one report type",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reportTypeId", description="report type id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *       @OA\Property(property="text", description="text", example="test", @OA\Schema(type="string") ),
     *       @OA\Property(property="parent_id", description="parent id", example="1", @OA\Schema(type="integer") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateReportTypeRequest $request, ReportType $reportType)
    {
        $type = $this->reportTypeService->updateItem($reportType['id'], $request->all());
        return $this->successJsonResponse(ReportTypeResource::make($type));
    }

    /**
     * @OA\Delete(
     *      path="/api/admin/reports/types/{reportTypeId}",
     *      operationId="destroyAdminReportTypes",
     *      tags={"Admin - Report Types"},
     *      summary="destroy one report type",
     *      description="destroy one report type",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reportTypeId", description="report type id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ReportType $reportType)
    {
        $this->reportTypeService->deleteItem($reportType['id']);
        return $this->successJsonResponse();
    }
}
