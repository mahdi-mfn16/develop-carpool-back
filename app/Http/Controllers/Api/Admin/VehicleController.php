<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\VehicleIndexRequest;
use App\Http\Requests\Vehicle\VehicleStoreRequest;
use App\Http\Requests\Vehicle\VehicleUpdateRequest;
use App\Http\Resources\Vehicle\VehicleCollection;
use App\Http\Resources\Vehicle\VehicleResource;
use App\Models\Vehicle;
use App\Services\Admin\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * @OA\Tag( name="Admin - Vehicle", @OA\ExternalDocumentation( description="", url="" ) )
     */


    public function __construct(
        private VehicleService $vehicleService
    )
    {}


    /**
     * @OA\Get(
     *      path="/api/admin/vehicles",
     *      operationId="getAdminVehicles",
     *      tags={"Admin - Vehicle"},
     *      summary="get list of vehicles ",
     *      description="get list of vehicles ",
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
    public function index(VehicleIndexRequest $request)
    {
        $vehicles = $this->vehicleService->getVehicles($request);
        return $this->successPaginateResponse(new VehicleCollection($vehicles));
    }



     /**
     * @OA\Post(
     *      path="/api/admin/vehicles",
     *      operationId="storeAdminVehicle",
     *      tags={"Admin - Vehicle"},
     *      summary="create one vehicle",
     *      description="create one vehicle ",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VehicleStoreRequest $request)
    {
        $vehicle = $this->vehicleService->createItem($request->all());
        return $this->successJsonResponse(VehicleResource::make($vehicle));
    }

    /**
     * @OA\Get(
     *      path="/api/admin/vehicles/{vehicleId}",
     *      operationId="showAdminVehicle",
     *      tags={"Admin - Vehicle"},
     *      summary="show one vehicle",
     *      description="show one vehicle",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="vehicleId", description="vehicle id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle = $this->vehicleService->showItem($vehicle['id']);
        return $this->successJsonResponse(VehicleResource::make($vehicle));
    }



    /**
     * @OA\Put(
     *      path="/api/admin/vehicles/{vehicleId}",
     *      operationId="updateAdminVehicle",
     *      tags={"Admin - Vehicle"},
     *      summary="update one vehicle",
     *      description="update one vehicle",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="vehicleId", description="vehicle id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $vehicle = $this->vehicleService->updateItem($vehicle['id'], $request->all());
        return $this->successJsonResponse(VehicleResource::make($vehicle));
    }

    /**
     * @OA\Delete(
     *      path="/api/admin/vehicles/{vehicleId}",
     *      operationId="destroyAdminVehicle",
     *      tags={"Admin - Vehicle"},
     *      summary="destroy one vehicle",
     *      description="destroy one vehicle",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="vehicleId", description="vehicle id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->deleteItem($vehicle['id']);
        return $this->successJsonResponse();

    }



}