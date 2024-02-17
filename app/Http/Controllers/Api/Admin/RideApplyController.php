<?php

namespace App\Http\Controllers\Api\Admin;

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
     * @OA\Tag( name="Admin - Ride Apply", @OA\ExternalDocumentation( description="", url="" ) )
     */


    public function __construct(
        private RideApplyService $rideApplyService
    )
    {}


}