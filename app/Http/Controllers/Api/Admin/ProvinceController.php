<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Province\IndexProvinceRequest;
use App\Http\Requests\Province\StoreProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;
use App\Http\Resources\Province\ProvinceCollection;
use App\Http\Resources\Province\ProvinceResource;
use App\Models\Province;
use App\Services\Admin\ProvinceService;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * @OA\Tag( name="Admin - Province", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private ProvinceService $provinceService
    ){}


    /**
     * @OA\Get(
     *      path="/api/admin/provinces",
     *      operationId="getAdminProvinces",
     *      tags={"Admin - Province"},
     *      summary="get list of provinces",
     *      description="get list of provinces",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
    *       @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexProvinceRequest $request)
    {
        $provinces = $this->provinceService->getProvinces($request);
        return $this->successPaginateResponse(new ProvinceCollection($provinces));
    }



    /**
     * @OA\Post(
     *      path="/api/admin/provinces",
     *      operationId="storeAdminProvince",
     *      tags={"Admin - Province"},
     *      summary="create one province",
     *      description="create one province",
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
    public function store(StoreProvinceRequest $request)
    {
        $province = $this->provinceService->createItem($request->all());
        return $this->successJsonResponse(ProvinceResource::make($province));
    }




    /**
     * @OA\Get(
     *      path="/api/admin/cities/{provinceId}",
     *      operationId="showAdminProvince",
     *      tags={"Admin - Province"},
     *      summary="show one province",
     *      description="show one province",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="provinceId", description="province id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Province $province)
    {
        $province = $this->provinceService->showItem($province['id']);
        return $this->successJsonResponse(ProvinceResource::make($province));
    }




    /**
     * @OA\Put(
     *      path="/api/admin/cities/{provinceId}",
     *      operationId="updateAdminProvince",
     *      tags={"Admin - Province"},
     *      summary="update one province",
     *      description="update one province",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="provinceId", description="province id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *         @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $province = $this->provinceService->updateItem($province['id'], $request->all());
        return $this->successJsonResponse(ProvinceResource::make($province));
    }


    

    /**
     * @OA\Delete(
     *      path="/api/admin/cities/{provinceId}",
     *      operationId="destroyAdminProvince",
     *      tags={"Admin - Province"},
     *      summary="destroy one province",
     *      description="destroy one province",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="provinceId", description="province id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Province $province)
    {
        $this->provinceService->deleteItem($province['id']);
        return $this->successJsonResponse();
    }
}
