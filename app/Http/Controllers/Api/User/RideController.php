<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ride\RideIndexRequest;
use App\Http\Requests\Ride\RideMyIndexRequest;
use App\Http\Requests\Ride\RideStoreRequest;
use App\Http\Resources\Ride\RideCollection;
use App\Http\Resources\Ride\RideResource;
use App\Services\User\RideService;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class RideController extends Controller
{
    /**
     * @OA\Tag(
     *      name="Ride",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    
    public function __construct(
        private RideService $rideService
    )
    {}
    

    /**
     * @OA\Get(
     *      path="/api/rides/my-rides",
     *      operationId="getMyRides",
     *      tags={"Ride"},
     *      summary="get list of my rides",
     *      description="get list of my rides",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="page",
     *         description="page",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Parameter(
     *         name="limit",
     *         description="limit",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
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
    public function getMyRides(RideMyIndexRequest $request)
    {
        $rides = $this->rideService->getMyRides($request);
        return $this->successPaginateResponse(new RideCollection($rides));
    }



    /**
     * @OA\Get(
     *      path="/api/rides",
     *      operationId="getAllRides",
     *      tags={"Ride"},
     *      summary="get list of rides",
     *      description="get list of rides",
     *      security={{"bearer":{}}},
     *      @OA\Parameter(
     *         name="page",
     *         description="page",
     *         in = "query",
     *         required=true,
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Parameter(
     *         name="limit",
     *         description="limit",
     *         in = "query",
     *         required=true,
     *         @OA\Schema(type="integer") 
     *       ),
    *       @OA\Parameter(
    *         name="filters[origin]",
    *         in="query",
    *         description="origin",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             example="1"
    *         )
    *     ),
    *       @OA\Parameter(
    *         name="filters[destination]",
    *         in="query",
    *         description="destination",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             example="1"
    *         )
    *     ),
    *       @OA\Parameter(
    *         name="filters[date]",
    *         in="query",
    *         description="date",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *             example="2023-11-22"
    *         )
    *     ),
    *       @OA\Parameter(
    *         name="filters[capacity]",
    *         in="query",
    *         description="capacity",
    *         required=true,
    *         @OA\Schema(
    *             type="integer",
    *             example="1"
    *         )
    *     ),
    *     @OA\Parameter(
    *         name="filters[type]",
    *         in="query",
    *         description="type",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *             example="passenger, rider"
    *         )),
    *     @OA\Parameter(
    *         name="filters[gender]",
    *         in="query",
    *         description="gender",
    *         required=false,
    *         @OA\Schema(
    *             type="integer",
    *             example="1"
    *         )
    *     ),
    *           @OA\Response(
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
    public function getAllRides(RideIndexRequest $request)
    {
        $rides = $this->rideService->getAllRides($request);
        return $this->successPaginateResponse(new RideCollection($rides));
    }




    public function createRide(RideStoreRequest $request)
    {
        // ride create gate
        
        $ride = $this->rideService->createRide($request);
        return $this->successJsonResponse(RideResource::make($ride));
    }

 
    




    
}
