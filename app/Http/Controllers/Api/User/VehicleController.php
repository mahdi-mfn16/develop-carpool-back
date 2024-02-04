<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\Admin\VehicleService;
use App\Services\User\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * @OA\Tag(
     *      name="Vehicle",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */


    public function __construct(
        private VehicleService $vehicleService
    )
    {}


}