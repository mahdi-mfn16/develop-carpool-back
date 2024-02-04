<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\User\PassengerApplyService;
use Illuminate\Http\Request;

class PassengerApplyController extends Controller
{


    public function __construct(
        private PassengerApplyService $passengerApplyService
    )
    {}
    

   


}
