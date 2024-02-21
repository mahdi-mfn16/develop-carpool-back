<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RideApply\StoreRideApplyRequest;
use App\Http\Requests\RideApply\UpdateRideApplyRequest;
use App\Http\Resources\RideApply\RideApplyResource;
use App\Models\Ride;
use App\Models\RideApply;
use App\Services\User\RideApplyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RideApplyController extends Controller
{

      /**
     * @OA\Tag(
     *      name="Ride Apply",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */


    public function __construct(
        private RideApplyService $rideApplyService
    )
    {}


    /**
     * @OA\Post(
     *      path="/api/rides/apply/{rideId}",
     *      operationId="sendRideApply",
     *      tags={"Ride Apply"},
     *      summary="create a ride apply",
     *      description="create a ride apply",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="rideId",
     *         description="ride id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\RequestBody(
     *      @OA\JsonContent(
     *      @OA\Property(
     *          property="capacity",
     *          description="capacity",
     *          example="1",
     *          @OA\Schema(type="integer")
     *          ),
     *     ),
     *     ),
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
    public function sendRideApply(StoreRideApplyRequest $request, Ride $ride)
    {        
        $rideApply = $this->rideApplyService->sendRideApply($request, $ride);
        return $this->successJsonResponse(RideApplyResource::make($rideApply));
    }


/**
     * @OA\Put(
     *      path="/api/rides/apply/status/{rideApplyId}",
     *      operationId="updateRideApplyStatus",
     *      tags={"Ride Apply"},
     *      summary="update a ride apply status",
     *      description="update a ride apply status",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="rideApplyId",
     *         description="ride apply id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\RequestBody(
     *      @OA\JsonContent(
     *      @OA\Property(
     *          property="action",
     *          description="action",
     *          example="accepted,rejected,canceled,accept_closed,reject_closed",
     *          @OA\Schema(type="string")
     *          ),
     *     ),
     *     ),
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
    public function updateRideApplyStatus(UpdateRideApplyRequest $request, RideApply $rideApply)
    {
        Gate::authorize('update', [$rideApply, $request->input('action')]);
        $rideApply = $this->rideApplyService->updateRideApplyStatus($request, $rideApply);
        return $this->successJsonResponse(RideApplyResource::make($rideApply));
    }
    

   


}
