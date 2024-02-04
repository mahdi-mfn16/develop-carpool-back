<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\AssignPlanRequest;
use App\Http\Requests\Plan\StorePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Plan;
use App\Models\Preference;
use App\Services\Admin\PreferenceOptionService;
use Illuminate\Http\Request;

class PreferenceOptionController extends Controller
{

    public function __construct(
        private PreferenceOptionService $preferenceOptionService
    ){}


    
}
