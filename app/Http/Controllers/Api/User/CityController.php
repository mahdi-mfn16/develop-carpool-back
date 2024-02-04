<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\IndexCityRequest;
use App\Http\Resources\City\CityResource;
use App\Services\Admin\CityService;

class CityController extends Controller
{
    /**
     * @OA\Tag(
     *      name="Location",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    public function __construct(
        private CityService $cityService
    ){}


    /**
     * Display a listing of the city.
     *
     */

     /**
     * @OA\Get(
     *      path="/api/cities",
     *      operationId="getCities",
     *      tags={"Location"},
     *      summary="get list of cities of province",
     *      description="get list of cities of province",
     *      security={{"bearer":{}}},
     *      @OA\Parameter(
     *         name="province_id",
     *         description="province_id",
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
    public function index(IndexCityRequest $request)
    {
        $cities = $this->cityService->getCities($request['province_id']);
        return $this->successArrayResponse(CityResource::collection($cities));
    }



}