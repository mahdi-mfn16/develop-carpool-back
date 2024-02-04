<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\AssignPlanRequest;
use App\Http\Requests\Plan\StorePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Plan;
use App\Services\Admin\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    // public function __construct(
    //     private PlanService $planService
    // ){}


    // /**
    //  * Display a listing of the plan.
    //  *
    //  */
    // public function index()
    // {
    //     $plans = $this->planService->getPlanList();
    //     return $this->successArrayResponse($plans);
    // }



    // /**
    //  * Store a newly created plan in storage.
    //  *
    //  */
    // public function store(StorePlanRequest $request)
    // {
    //     $plan = $this->planService->createItem($request->all());
    //     return $this->successJsonResponse($plan);
    // }

    // /**
    //  * Display the specified plan.
    //  *
    //  */
    // public function show(Plan $plan)
    // {
    //     $plan = $this->planService->showItem($plan['id']);
    //     return $this->successJsonResponse($plan);
    // }




    // /**
    //  * Update the specified plan in storage.
    //  *
    //  */
    // public function update(UpdatePlanRequest $request, Plan $plan)
    // {
    //     $plan = $this->planService->updateItem($plan['id'], $request->all());
    //     return $this->successJsonResponse($plan);
    // }

    // /**
    //  * Remove the specified plan from storage.
    //  *
    //  */
    // public function destroy(Plan $plan)
    // {
    //     $this->planService->deleteItem($plan['id']);
    //     return $this->successJsonResponse();
    // }
}
