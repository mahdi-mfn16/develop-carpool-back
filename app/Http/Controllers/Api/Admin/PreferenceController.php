<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\AssignPlanRequest;
use App\Http\Requests\Plan\StorePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Models\Plan;
use App\Models\Preference;
use App\Services\Admin\PreferenceService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    public function __construct(
        private PreferenceService $preferenceService
    ){}


   
}
