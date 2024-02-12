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

class RideApplyController extends Controller
{


    public function __construct(
        private RideApplyService $rideApplyService
    )
    {}



    public function sendRideApply(StoreRideApplyRequest $request, Ride $ride)
    {
        $rideApply = $this->rideApplyService->sendRideApply($request, $ride);
        return $this->successJsonResponse(RideApplyResource::make($rideApply));
    }



    public function responseRideApply(UpdateRideApplyRequest $request, RideApply $rideApply)
    {
        $rideApply = $this->rideApplyService->responseRideApply($request, $rideApply);
        return $this->successJsonResponse(RideApplyResource::make($rideApply));
    }
    

   


}
