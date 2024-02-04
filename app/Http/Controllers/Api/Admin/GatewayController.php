<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gateway\StoreGatewayRequest;
use App\Http\Requests\Gateway\UpdateGatewayRequest;
use App\Models\Gateway;
use App\Services\Admin\GatewayService;
use Illuminate\Http\Request;

class GatewayController extends Controller
{

    public function __construct(
        private GatewayService $gatewayService
    ){}


    /**
     * Display a listing of the gateway.
     *
     */
    public function index()
    {
        $gateways = $this->gatewayService->indexAllItems();
        return $this->successArrayResponse($gateways);
    }



    /**
     * Store a newly created gateway in storage.
     *
     */
    public function store(StoreGatewayRequest $request)
    {
        $gateway = $this->gatewayService->createItem($request->all());
        return $this->successJsonResponse($gateway);
    }


    /**
     * Display the specified gateway.
     *
     */
    public function show(Gateway $gateway)
    {
        $gateway = $this->gatewayService->showItem($gateway['id']);
        return $this->successJsonResponse($gateway);
    }



    /**
     * Update the specified gateway in storage.
     *
     */
    public function update(UpdateGatewayRequest $request, Gateway $gateway)
    {
        $gateway = $this->gatewayService->updateItem($gateway['id'], $request->all());
        return $this->successJsonResponse($gateway);
    }


    /**
     * Remove the specified gateway from storage.
     *
     */
    public function destroy(Gateway $gateway)
    {
        $this->gatewayService->deleteItem($gateway['id']);
        return $this->successJsonResponse();
    }
}
