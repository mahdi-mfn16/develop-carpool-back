<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\VehicleIndexRequest;
use App\Http\Resources\Vehicle\VehicleCollection;
use App\Services\Admin\VehicleService;
use App\Services\User\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * @OA\Tag(
     *      name="Vehicle",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */


    public function __construct(
        private VehicleService $vehicleService
    )
    {}

    /**
     * @OA\Get(
     *      path="/api/vehicles",
     *      operationId="getVehicles",
     *      tags={"Vehicle"},
     *      summary="get list of vehicles",
     *      description="get list of vehicles",
     *      security={{"bearer":{}}},
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
     *      ),
    *       @OA\Parameter(
    *         name="filters[search]",
    *         in="query",
    *         description="search",
    *         @OA\Schema(
    *             type="string",
    *             example=""
    *         )
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
    public function getVehicles(VehicleIndexRequest $request)
    {
        $vehicles = $this->vehicleService->getVehicles($request);
        return $this->successPaginateResponse(new VehicleCollection($vehicles));
    }


}