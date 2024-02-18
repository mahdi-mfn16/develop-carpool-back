<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([])->group(function () {

// ----------------- City Route ------------------------
    Route::controller('CityController')->prefix('cities')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{cityId}', 'show');
        Route::put('/{cityId}', 'update');
        Route::delete('/{cityId}', 'destroy');
    });

// ----------------- Province Route ------------------------
    Route::controller('ProvinceController')->prefix('provinces')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{provinceId}', 'show');
        Route::put('/{provinceId}', 'update');
        Route::delete('/{provinceId}', 'destroy');
    });

// ----------------- Notification Type Route ------------------------
    Route::controller('NotificationTypeController')->prefix('notifications/types')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{notificationTypeId}', 'show');
        Route::put('/{notificationTypeId}', 'update');
        Route::delete('/{notificationTypeId}', 'destroy');
    });

// ----------------- Report Type Route ------------------------
    Route::controller('ReportTypeController')->prefix('reports/types')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{reportTypeId}', 'show');
        Route::put('/{reportTypeId}', 'update');
        Route::delete('/{reportTypeId}', 'destroy');
    });

// ----------------- Preference Option Route ------------------------
    Route::controller('PreferenceOptionController')->prefix('preferences/options')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{preferenceOptionId}', 'show');
        Route::put('/{preferenceOptionId}', 'update');
        Route::delete('/{preferenceOptionId}', 'destroy');
    });


// ----------------- Preference Route ------------------------
    Route::controller('PreferenceController')->prefix('preferences')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{preferenceId}', 'show');
        Route::put('/{preferenceId}', 'update');
        Route::delete('/{preferenceId}', 'destroy');
    });

// ----------------- Report Route ------------------------
    Route::controller('ReportController')->prefix('reports')->group(function(){
        Route::get('/', 'index');
        Route::get('/{reportId}', 'show');
        Route::delete('/{reportId}', 'destroy');
    });

// ----------------- Review Route ------------------------
    Route::controller('ReviewController')->prefix('reviews')->group(function(){
        Route::get('/', 'index');
        Route::get('/{reviewId}', 'show');
        Route::delete('/{reviewId}', 'destroy');
        Route::put('/toggle-status/{reviewId}', 'destroy');
    });

// ----------------- User Vehicle Route ------------------------
    Route::controller('UserVehicleController')->prefix('vehicles/user')->group(function(){
        Route::get('/', 'index');
        Route::get('/', 'show');
        Route::put('/update-status/{userVehicleId}', 'updateStatus');
    });


// ----------------- Vehicle Route ------------------------
    Route::controller('VehicleController')->prefix('vehicles')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{vehicleId}', 'show');
        Route::put('/{vehicleId}', 'update');
        Route::delete('/{vehicleId}', 'destroy');   
    });


 // ----------------- User Route ------------------------
    Route::controller('UserController')->prefix('users')->group(function(){
        Route::get('/', 'index');
        Route::get('/{userId}', 'show');
    });
    
    
    
    
    // ----------------- Ride Route ------------------------
        // Route::controller('RideController')->prefix('rides')->group(function(){
        //     Route::get('/my-rides', 'getMyRides');
            
        // });
    
    
    // ----------------- Ride Apply Route ------------------------
        // Route::controller('RideApplyController')->prefix('rides/apply')->group(function(){
        //     Route::post('/{rideId}', 'sendRideApply');
        //     Route::put('/status/{rideApplyId}', 'updateRideApplyStatus');
            
        // });
        
});
