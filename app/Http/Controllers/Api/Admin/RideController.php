<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ride\RideAdminIndexRequest;
use App\Http\Requests\Ride\RideIndexRequest;
use App\Http\Requests\Ride\RideMyIndexRequest;
use App\Http\Requests\Ride\RideStoreRequest;
use App\Http\Resources\Ride\RideCollection;
use App\Http\Resources\Ride\RideResource;
use App\Models\Ride;
use App\Services\User\RideService;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class RideController extends Controller
{

    /**
     * @OA\Tag( name="Admin - Ride", @OA\ExternalDocumentation( description="", url="" ) )
     */
    
    public function __construct(
        private RideService $rideService
    )
    {}



    /**
     * @OA\Get(
     *      path="/api/admin/rides",
     *      operationId="getAdminRides",
     *      tags={"Admin - User"},
     *      summary="get list of rides",
     *      description="get list of rides",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
    *       @OA\Parameter( name="filters[origin]", in="query", description="origin city id", @OA\Schema( type="integer", example="" ) ),
    *       @OA\Parameter( name="filters[destination]", in="query", description="destination city id", @OA\Schema( type="integer", example="" ) ),
    *       @OA\Parameter( name="filters[user_id]", in="query", description="user id", @OA\Schema( type="integer", example="" ) ),
    *       @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RideAdminIndexRequest $request)
    {
        $rides = $this->rideService->getAdminRideList($request);
        return $this->successPaginateResponse(new RideCollection($rides));
    }



    /**
     * @OA\Get(
     *      path="/api/admin/rides/{rideId}",
     *      operationId="showAdminRide",
     *      tags={"Admin - Ride"},
     *      summary="show one ride",
     *      description="show one ride",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="rideId", description="ride id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ride $ride)
    {
        $ride = $this->rideService->showItem($ride['id']);
        return $this->successArrayResponse(RideResource::make($ride));
    }
    


 
    




    
}
