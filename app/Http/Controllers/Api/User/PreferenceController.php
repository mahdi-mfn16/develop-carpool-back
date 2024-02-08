<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Province\StoreProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;
use App\Http\Resources\Preference\PreferenceResource;
use App\Models\Province;
use App\Services\Admin\PreferenceService;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    /**
     * @OA\Tag(
     *      name="User Preference",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    public function __construct(
        private PreferenceService $preferenceService
    ){}


    /**
     * @OA\Get(
     *      path="/api/preferences",
     *      operationId="getPreferences",
     *      tags={"User Preference"},
     *      summary="get list of preferences",
     *      description="get list of preferences",
     *      security={{"bearer_token":{}}},  
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
    public function getPreferences()
    {
        $preferences = $this->preferenceService->getUserPreferences();
        return $this->successArrayResponse(PreferenceResource::collection($preferences));
    }


}
