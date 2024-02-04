<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Province\StoreProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;
use App\Models\Province;
use App\Services\Admin\ProvinceService;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    public function __construct(
        private ProvinceService $provinceService
    ){}


    /**
     * Display a listing of the province.
     *
     */
    public function index()
    {
        $provinces = $this->provinceService->indexAllItems();
        return $this->successArrayResponse($provinces);
    }



    /**
     * Store a newly created city in storage.
     *
     */
    public function store(StoreProvinceRequest $request)
    {
        $province = $this->provinceService->createItem($request->all());
        return $this->successJsonResponse($province);
    }




    /**
     * Display the specified province.
     *
     */
    public function show(Province $province)
    {
        $province = $this->provinceService->showItem($province['id']);
        return $this->successJsonResponse($province);
    }




    /**
     * Update the specified province in storage.
     *
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $province = $this->provinceService->updateItem($province['id'], $request->all());
        return $this->successJsonResponse($province);
    }


    

    /**
     * Remove the specified province from storage.
     *
     */
    public function destroy(Province $province)
    {
        $this->provinceService->deleteItem($province['id']);
        return $this->successJsonResponse();
    }
}
