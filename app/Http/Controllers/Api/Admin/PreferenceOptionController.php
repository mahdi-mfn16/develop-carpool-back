<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\AssignPlanRequest;
use App\Http\Requests\Plan\StorePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Http\Requests\PreferenceOption\IndexPreferenceOptionRequest;
use App\Http\Requests\PreferenceOption\StorePreferenceOptionRequest;
use App\Http\Requests\PreferenceOption\UpdatePreferenceOptionRequest;
use App\Http\Resources\PreferenceOption\PreferenceOptionCollection;
use App\Http\Resources\PreferenceOption\PreferenceOptionResource;
use App\Models\Plan;
use App\Models\Preference;
use App\Models\PreferenceOption;
use App\Services\Admin\PreferenceOptionService;
use Illuminate\Http\Request;

class PreferenceOptionController extends Controller
{

    /**
     * @OA\Tag( name="Admin - Preference Option", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private PreferenceOptionService $preferenceOptionService
    ){}



    /**
     * @OA\Get(
     *      path="/api/admin/preferences/options",
     *      operationId="getAdminPreferenceOptions",
     *      tags={"Admin - Preference Option"},
     *      summary="get list of preferences ",
     *      description="get list of preferences ",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Parameter( name="filters[preference_id]", in="query", description="preference id", @OA\Schema( type="integer", example="" ) ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexPreferenceOptionRequest $request)
    {
        $options = $this->preferenceOptionService->getPreferenceOptions($request);
        return $this->successPaginateResponse(new PreferenceOptionCollection($options));
    }


     /**
     * @OA\Post(
     *      path="/api/admin/preferences/options",
     *      operationId="storeAdminPreferenceOption",
     *      tags={"Admin - Preference Option"},
     *      summary="create one preference option",
     *      description="create one preference option",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="preference_id", description="preference id", example="test", @OA\Schema(type="integer") ),
     *       @OA\Property(property="text", description="text", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePreferenceOptionRequest $request)
    {
        $option = $this->preferenceOptionService->createItem($request->all());
        return $this->successJsonResponse(PreferenceOptionResource::make($option));
    }

    /**
     * @OA\Get(
     *      path="/api/admin/preferences/options/{preferenceOptionId}",
     *      operationId="showAdminPreferenceOption",
     *      tags={"Admin - Preference Option"},
     *      summary="show one preference option",
     *      description="show one preference option",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="preferenceOptionId", description="preference option id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(PreferenceOption $preferenceOption)
    {
        $option = $this->preferenceOptionService->showItem($preferenceOption['id']);
        return $this->successJsonResponse(PreferenceOptionResource::make($option));
    }



    /**
     * @OA\Put(
     *      path="/api/admin/preferences/options/{preferenceOptionId}",
     *      operationId="updateAdminPreferenceOption",
     *      tags={"Admin - Preference Option"},
     *      summary="update one preference option",
     *      description="update one preference option",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="preferenceOptionId", description="preference option id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="preference_id", description="preference id", example="test", @OA\Schema(type="integer") ),
     *       @OA\Property(property="text", description="text", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePreferenceOptionRequest $request, PreferenceOption $preferenceOption)
    {
        $option = $this->preferenceOptionService->updateItem($preferenceOption['id'], $request->all());
        return $this->successJsonResponse(PreferenceOptionResource::make($option));
    }

    /**
     * @OA\Delete(
     *      path="/api/admin/preferences/options/{preferenceOptionId}",
     *      operationId="destroyAdminPreferenceOption",
     *      tags={"Admin - Preference Option"},
     *      summary="destroy one preference option",
     *      description="destroy one preference option",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="preferenceOptionId", description="preference option id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PreferenceOption $preferenceOption)
    {
        $this->preferenceOptionService->deleteItem($preferenceOption['id']);
        return $this->successJsonResponse();

    }


    
}
