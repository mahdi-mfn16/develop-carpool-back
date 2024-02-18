<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RideApply\IndexRideApplyRequest;
use App\Http\Requests\RideApply\StoreRideApplyRequest;
use App\Http\Requests\RideApply\UpdateRideApplyRequest;
use App\Http\Resources\RideApply\RideApplyCollection;
use App\Http\Resources\RideApply\RideApplyResource;
use App\Models\Ride;
use App\Models\RideApply;
use App\Services\User\RideApplyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RideApplyController extends Controller
{

    /**
     * @OA\Tag( name="Admin - Ride Apply", @OA\ExternalDocumentation( description="", url="" ) )
     */


    public function __construct(
        private RideApplyService $rideApplyService
    )
    {}



    /**
     * @OA\Get(
     *      path="/api/admin/rides/apply",
     *      operationId="getAdminRideApplies",
     *      tags={"Admin - Ride Apply"},
     *      summary="get list of ride applies",
     *      description="get list of ride applies",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
    *       @OA\Parameter( name="filters[ride_id]", in="query", description="ride id", @OA\Schema( type="string", example="" ) ),
    *       @OA\Parameter( name="filters[status]", in="query", description="status", @OA\Schema( type="integer", example="" ) ),
    *       @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRideApplyRequest $request)
    {
        $users = $this->rideApplyService->getRideApplyList($request);
        return $this->successPaginateResponse(new RideApplyCollection($users));
    }



    /**
     * @OA\Get(
     *      path="/api/admin/rides/apply/{rideApplyId}",
     *      operationId="showAdminRideApply",
     *      tags={"Admin - Ride Apply"},
     *      summary="show one ride apply",
     *      description="show one ride apply",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="rideApplyId", description="ride apply id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RideApply $rideApply)
    {
        $rideApply = $this->rideApplyService->showItem($rideApply['id']);
        return $this->successArrayResponse(RideApplyResource::make($rideApply));
    }


}