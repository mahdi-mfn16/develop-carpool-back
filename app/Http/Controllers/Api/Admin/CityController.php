<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\IndexCityRequest;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Models\City;
use App\Services\Admin\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(
        private CityService $cityService
    ){}



    /**
     * Display a listing of the city.
     *
     */
    public function index(IndexCityRequest $request)
    {
        $cities = $this->cityService->getCities($request['province_id']);
        return $this->successArrayResponse($cities);
    }



    /**
     * Store a newly created city in storage.
     *
     */
    public function store(StoreCityRequest $request)
    {
        $city = $this->cityService->createItem($request->all());
        return $this->successJsonResponse($city);
    }



    /**
     * Display the specified city.
     *
     */
    public function show(City $city)
    {
        $city = $this->cityService->showItem($city['id']);
        return $this->successJsonResponse($city);
    }




    /**
     * Update the specified city in storage.
     *
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city = $this->cityService->updateItem($city['id'], $request->all());
        return $this->successJsonResponse($city);
    }



    /**
     * Remove the specified city from storage.
     *
     */
    public function destroy(City $city)
    {
        $this->cityService->deleteItem($city['id']);
        return $this->successJsonResponse();
    }
}
