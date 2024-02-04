<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Province\ProvinceResource;
use App\Services\Admin\ProvinceService;

class ProvinceController extends Controller
{

    public function __construct(
        private ProvinceService $provinceService
    ){}


    /**
     * @OA\Get(
     *      path="/api/provinces",
     *      operationId="getProvinces",
     *      tags={"Location"},
     *      summary="get list of provinces",
     *      description="get list of provinces",
     *      security={{"bearer":{}}},  
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
    public function index()
    {
        $provinces = $this->provinceService->indexAllItems();
        return $this->successArrayResponse(ProvinceResource::collection($provinces));
    }


}
