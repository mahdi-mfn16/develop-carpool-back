<?php

return [


    /*
    |--------------------------------------------------------------------------
    | User Privilege
    |--------------------------------------------------------------------------
    | status of users
    |
    */

    'privilege' => [
        'admin_user' => 10,
        'free_user' => 0,
        'vip_user' => 1,
        'fake_user' => -1,
    ],


    'ride_apply_status' => [
        'pending' => 0,
        'accepted' => 1, 
        'rejected' => 2,
        'canceled' => 3,
        'accept_closed' => 4,
        'reject_closed' => 5,
    ],


    'user_vehicle_status' => [
        'pending' => 0,
        'accepted' => 1, 
        'rejected' => 2,
    ],

];
