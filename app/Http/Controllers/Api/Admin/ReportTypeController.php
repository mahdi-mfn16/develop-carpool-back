<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportType\StoreReportTypeRequest;
use App\Http\Requests\ReportType\UpdateReportTypeRequest;
use App\Models\ReportType;
use App\Services\Admin\ReportTypeService;
use Illuminate\Http\Request;

class ReportTypeController extends Controller
{

    public function __construct(
        private ReportTypeService $reportTypeService
    ){}


    /**
     * Display a listing of the report type.
     *
     */
    public function index()
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
