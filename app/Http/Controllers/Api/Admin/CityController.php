<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\IndexCityRequest;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Resources\City\CityCollection;
use App\Http\Resources\City\CityResource;
use App\Models\City;
use App\Services\Admin\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @OA\Tag( name="Admin - City", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private CityService $cityService
    ){}



    /**
     * @OA\Get(
     *      path="/api/admin/cities",
     *      operationId="getAdminCities",
     *      tags={"Admin - City"},
     *      summary="get list of cities of province",
     *      description="get list of cities of province",
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
     *      @OA\Parameter(
    *         name="filters[province_id]",
    *         in="query",
    *         description="province_id",
    *         @OA\Schema(
    *             type="integer",
    *             example="1"
    *         )
    *     ),
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
    public function index(IndexCityRequest $request)
    {
        $cities = $this->cityService->getCities($request);
        return $this->successPaginateResponse(new CityCollection($cities));
    }



    /**
     * @OA\Post(
     *      path="/api/admin/cities",
     *      operationId="storeAdminCity",
     *      tags={"Admin - City"},
     *      summary="create one city",
     *      description="create one city",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *       @OA\JsonContent(
     *       @OA\Property(
     *          property="name",
     *          description="name",
     *          example="test",
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="province_id",
     *          description="province id",
     *          example=1,
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
    public function store(StoreCityRequest $request)
    {
        $city = $this->cityService->createItem($request->all());
        return $this->successJsonResponse(CityResource::make($city));
    }



    /**
     * @OA\Get(
     *      path="/api/admin/cities/{cityId}",
     *      operationId="showAdminCity",
     *      tags={"Admin - City"},
     *      summary="show one city",
     *      description="show one city",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="cityId",
     *         description="city id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(City $city)
    {
        $city = $this->cityService->showItem($city['id']);
        return $this->successJsonResponse($city);
    }




    /**
     * @OA\Put(
     *      path="/api/admin/cities/{cityId}",
     *      operationId="updateAdminCity",
     *      tags={"Admin - City"},
     *      summary="update one city",
     *      description="update one city",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="cityId",
     *         description="city id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\RequestBody(
     *       @OA\JsonContent(
     *       @OA\Property(
     *          property="name",
     *          description="name",
     *          example=1,
     *          @OA\Schema(type="string")
     *          ),
     *      @OA\Property(
     *          property="province_id",
     *          description="province id",
     *          example=1,
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
    public function update(UpdateCityRequest $request, City $city)
    {
        $city = $this->cityService->updateItem($city['id'], $request->all());
        return $this->successJsonResponse($city);
    }



    /**
     * @OA\Delete(
     *      path="/api/admin/cities/{cityId}",
     *      operationId="destroyAdminCity",
     *      tags={"Admin - City"},
     *      summary="destroy one city",
     *      description="destroy one city",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="cityId",
     *         description="city id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(City $city)
    {
        $this->cityService->deleteItem($city['id']);
        return $this->successJsonResponse();
    }
}
