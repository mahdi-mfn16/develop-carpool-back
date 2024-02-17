<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Preference\IndexPreferenceRequest;
use App\Http\Requests\Preference\StorePreferenceRequest;
use App\Http\Requests\Preference\UpdatePreferenceRequest;
use App\Http\Resources\Preference\PreferenceCollection;
use App\Http\Resources\Preference\PreferenceResource;
use App\Models\Preference;
use App\Services\Admin\PreferenceService;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * @OA\Tag( name="Admin - Preference", @OA\ExternalDocumentation( description="", url="" ) )
     */
    public function __construct(
        private PreferenceService $preferenceService
    ){}


    /**
     * @OA\Get(
     *      path="/api/admin/preferences",
     *      operationId="getAdminPreferences",
     *      tags={"Admin - Preference"},
     *      summary="get list of preferences ",
     *      description="get list of preferences ",
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
    public function index(IndexPreferenceRequest $request)
    {
        $preferences = $this->preferenceService->getPreferences($request);
        return $this->successPaginateResponse(new PreferenceCollection($preferences));
    }


     /**
     * @OA\Post(
     *      path="/api/admin/preferences",
     *      operationId="storeAdminPreference",
     *      tags={"Admin - Preference"},
     *      summary="create one preference",
     *      description="create one preference ",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
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
    public function store(StorePreferenceRequest $request)
    {
        $preference = $this->preferenceService->createItem($request->all());
        return $this->successJsonResponse(PreferenceResource::make($preference));
    }

    /**
     * @OA\Get(
     *      path="/api/admin/preferences/{preferenceId}",
     *      operationId="showAdminPreference",
     *      tags={"Admin - Preference"},
     *      summary="show one preference",
     *      description="show one preference",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="preferenceId", description="preference id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Preference $preference)
    {
        $preference = $this->preferenceService->showItem($preference['id']);
        return $this->successJsonResponse(PreferenceResource::make($preference));
    }



    /**
     * @OA\Put(
     *      path="/api/admin/preferences/{preferenceId}",
     *      operationId="updateAdminPreference",
     *      tags={"Admin - Preference"},
     *      summary="update one preference",
     *      description="update one preference",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="preferenceId", description="preference id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
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
    public function update(UpdatePreferenceRequest $request, Preference $preference)
    {
        $preference = $this->preferenceService->updateItem($preference['id'], $request->all());
        return $this->successJsonResponse(PreferenceResource::make($preference));
    }

    /**
     * @OA\Delete(
     *      path="/api/admin/preferences/{preferenceId}",
     *      operationId="destroyAdminPreference",
     *      tags={"Admin - Preference"},
     *      summary="destroy one preference",
     *      description="destroy one preference",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="preferenceId", description="preference id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Preference $preference)
    {
        $this->preferenceService->deleteItem($preference['id']);
        return $this->successJsonResponse();

    }


   
}
