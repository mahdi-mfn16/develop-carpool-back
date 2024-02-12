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
        'accept' => 1, 
        'reject' => 2,
        'cancel' => 3,
        'closed' => 4,
    ],

];
