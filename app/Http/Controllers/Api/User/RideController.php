<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ride\RideDuplicateRequest;
use App\Http\Requests\Ride\RideIndexRequest;
use App\Http\Requests\Ride\RideMyIndexRequest;
use App\Http\Requests\Ride\RideStoreRequest;
use App\Http\Requests\Ride\RideUpdateRequest;
use App\Http\Resources\Ride\RideCollection;
use App\Http\Resources\Ride\RideResource;
use App\Models\Ride;
use App\Services\User\RideService;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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



   /**
     * @OA\Post(
     *      path="/api/rides",
     *      operationId="createRide",
     *      tags={"Ride"},
     *      summary="create one ride",
     *      description="create one ride",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="origin", description="origin", @OA\Schema(type="array"), 
     *          @OA\Property(property="city_id", description="city_id", example="1", @OA\Schema(type="integer") ),
     *          @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *          @OA\Property(property="lat", description="lat", example="22.3", @OA\Schema(type="float") ),
     *          @OA\Property(property="lng", description="lng", example="22.5", @OA\Schema(type="float") ),
     *      ),
     *      @OA\Property(property="destination", description="destination", @OA\Schema(type="array"), 
     *          @OA\Property(property="city_id", description="city_id", example="1", @OA\Schema(type="integer") ),
     *          @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *          @OA\Property(property="lat", description="lat", example="22.3", @OA\Schema(type="float") ),
     *          @OA\Property(property="lng", description="lng", example="22.5", @OA\Schema(type="float") ),
     *      ),
     *      @OA\Property(property="direction", description="direction", @OA\Schema(type="array"), 
     *          @OA\Property(property="coordinates", description="coordinates", example="[]", @OA\Schema(type="array") ),
     *          @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *          @OA\Property(property="route_index", description="route_index", example="1", @OA\Schema(type="integer") ),
     *          @OA\Property(property="distance", description="distance", example="22.5km", @OA\Schema(type="string") ),
     *          @OA\Property(property="time", description="time", example="20:30", @OA\Schema(type="string") ),
     *      ),
     *      @OA\Property(property="type", description="type", example="rider,passenger", @OA\Schema(type="string") ),
     *      @OA\Property(property="date", description="date", example="2024-04-01", @OA\Schema(type="string") ),
     *      @OA\Property(property="start_time", description="start_time", example="13:20", @OA\Schema(type="string") ),
     *      @OA\Property(property="user_vehicle_id", description="user_vehicle_id", example="1", @OA\Schema(type="integer") ),
     *      @OA\Property(property="capacity", description="capacity", example="3", @OA\Schema(type="integer") ),
     *      @OA\Property(property="price", description="price", example="21.0", @OA\Schema(type="float") ),
     *      @OA\Property(property="description", description="description", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRide(RideStoreRequest $request)
    {        
        $ride = $this->rideService->createRide($request);
        return $this->successJsonResponse(RideResource::make($ride));
    }



    /**
     * @OA\Get(
     *      path="/api/rides/{rideId}",
     *      operationId="showRide",
     *      tags={"Ride"},
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
    public function showRide(Ride $ride)
    {        
        $ride = $this->rideService->showItem($ride['id']);
        return $this->successJsonResponse(RideResource::make($ride));
    }





    /**
     * @OA\Put(
     *      path="/api/rides/{rideId}",
     *      operationId="updateRide",
     *      tags={"Ride"},
     *      summary="update one ride",
     *      description="update one ride",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="rideId", description="ride id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="origin", description="origin", @OA\Schema(type="array"), 
     *          @OA\Property(property="city_id", description="city_id", example="1", @OA\Schema(type="integer") ),
     *          @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *          @OA\Property(property="lat", description="lat", example="22.3", @OA\Schema(type="float") ),
     *          @OA\Property(property="lng", description="lng", example="22.5", @OA\Schema(type="float") ),
     *      ),
     *      @OA\Property(property="destination", description="destination", @OA\Schema(type="array"), 
     *          @OA\Property(property="city_id", description="city_id", example="1", @OA\Schema(type="integer") ),
     *          @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *          @OA\Property(property="lat", description="lat", example="22.3", @OA\Schema(type="float") ),
     *          @OA\Property(property="lng", description="lng", example="22.5", @OA\Schema(type="float") ),
     *      ),
     *      @OA\Property(property="direction", description="direction", @OA\Schema(type="array"), 
     *          @OA\Property(property="coordinates", description="coordinates", example="[]", @OA\Schema(type="array") ),
     *          @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *          @OA\Property(property="route_index", description="route_index", example="1", @OA\Schema(type="integer") ),
     *          @OA\Property(property="distance", description="distance", example="22.5km", @OA\Schema(type="string") ),
     *          @OA\Property(property="time", description="time", example="20:30", @OA\Schema(type="string") ),
     *      ),
     *      @OA\Property(property="type", description="type", example="rider,passenger", @OA\Schema(type="string") ),
     *      @OA\Property(property="date", description="date", example="2024-04-01", @OA\Schema(type="string") ),
     *      @OA\Property(property="start_time", description="start_time", example="13:20", @OA\Schema(type="string") ),
     *      @OA\Property(property="user_vehicle_id", description="user_vehicle_id", example="1", @OA\Schema(type="integer") ),
     *      @OA\Property(property="capacity", description="capacity", example="3", @OA\Schema(type="integer") ),
     *      @OA\Property(property="price", description="price", example="21.0", @OA\Schema(type="float") ),
     *      @OA\Property(property="description", description="description", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRide(RideUpdateRequest $request, Ride $ride)
    {   
        Gate::authorize('update', $ride);

        $ride = $this->rideService->updateRide($ride, $request);
        return $this->successJsonResponse(RideResource::make($ride));
    }




    /**
     * @OA\post(
     *      path="/api/rides/{rideId}/duplicate",
     *      operationId="duplicateRide",
     *      tags={"Ride"},
     *      summary="duplicate one ride",
     *      description="duplicate one ride",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="rideId", description="ride id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *        @OA\Property(property="date", description="date", example="2024-04-01", @OA\Schema(type="string") ),
     *        @OA\Property(property="start_time", description="start_time", example="13:20", @OA\Schema(type="string") ),
     *        @OA\Property(property="price", description="price", example="21.0", @OA\Schema(type="float") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function duplicateRide(RideDuplicateRequest $request, Ride $ride)
    {    
        
        // time()
        // date()
        // Price 
        // Gate::authorize('update', $ride);
        // $ride = $this->rideService->cancelRide($ride);
        // return $this->successJsonResponse(RideResource::make($ride));
    }



    /**
     * @OA\Put(
     *      path="/api/rides/{rideId}/cancel",
     *      operationId="cancelRide",
     *      tags={"Ride"},
     *      summary="cancel one ride",
     *      description="cancel one ride",
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
    public function cancelRide(Ride $ride)
    {        
        Gate::authorize('update', $ride);
        $ride = $this->rideService->cancelRide($ride);
        return $this->successJsonResponse(RideResource::make($ride));
    }

 
    




    
}
