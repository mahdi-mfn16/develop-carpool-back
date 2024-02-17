<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ride\RideIndexRequest;
use App\Http\Requests\Ride\RideMyIndexRequest;
use App\Http\Requests\Ride\RideStoreRequest;
use App\Http\Resources\Ride\RideCollection;
use App\Http\Resources\Ride\RideResource;
use App\Services\User\RideService;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class RideController extends Controller
{

    /**
     * @OA\Tag( name="Admin - Ride", @OA\ExternalDocumentation( description="", url="" ) )
     */
    
    public function __construct(
        private RideService $rideService
    )
    {}
    


 
    




    
}
