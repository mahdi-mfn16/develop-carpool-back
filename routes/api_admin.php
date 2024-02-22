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
        Route::get('/{city}', 'show');
        Route::put('/{city}', 'update');
        Route::delete('/{city}', 'destroy');
    });

// ----------------- Province Route ------------------------
    Route::controller('ProvinceController')->prefix('provinces')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{province}', 'show');
        Route::put('/{province}', 'update');
        Route::delete('/{province}', 'destroy');
    });

// ----------------- Notification Type Route ------------------------
    Route::controller('NotificationTypeController')->prefix('notifications/types')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{notificationType}', 'show');
        Route::put('/{notificationType}', 'update');
        Route::delete('/{notificationType}', 'destroy');
    });

// ----------------- Report Type Route ------------------------
    Route::controller('ReportTypeController')->prefix('reports/types')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{reportType}', 'show');
        Route::put('/{reportType}', 'update');
        Route::delete('/{reportType}', 'destroy');
    });

// ----------------- Preference Option Route ------------------------
    Route::controller('PreferenceOptionController')->prefix('preferences/options')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{preferenceOption}', 'show');
        Route::put('/{preferenceOption}', 'update');
        Route::delete('/{preferenceOption}', 'destroy');
    });


// ----------------- Preference Route ------------------------
    Route::controller('PreferenceController')->prefix('preferences')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{preference}', 'show');
        Route::put('/{preference}', 'update');
        Route::delete('/{preference}', 'destroy');
    });

// ----------------- Report Route ------------------------
    Route::controller('ReportController')->prefix('reports')->group(function(){
        Route::get('/', 'index');
        Route::get('/{report}', 'show');
        Route::delete('/{report}', 'destroy');
    });

// ----------------- Review Route ------------------------
    Route::controller('ReviewController')->prefix('reviews')->group(function(){
        Route::get('/', 'index');
        Route::get('/{review}', 'show');
        Route::delete('/{review}', 'destroy');
        Route::put('/toggle-status/{review}', 'destroy');
    });

// ----------------- User Vehicle Route ------------------------
    Route::controller('UserVehicleController')->prefix('vehicles/user')->group(function(){
        Route::get('/', 'index');
        Route::get('/', 'show');
        Route::put('/update-status/{userVehicle}', 'updateStatus');
    });


// ----------------- Vehicle Route ------------------------
    Route::controller('VehicleController')->prefix('vehicles')->group(function(){
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{vehicle}', 'show');
        Route::put('/{vehicle}', 'update');
        Route::delete('/{vehicle}', 'destroy');   
    });


 // ----------------- User Route ------------------------
    Route::controller('UserController')->prefix('users')->group(function(){
        Route::get('/', 'index');
        Route::get('/{user}', 'show');
        Route::put('/update-status/{user}', 'updateStatus');
        Route::get('/files/{user}', 'getUserFiles');
        Route::put('/verify-profile/{file}', 'verifyProfile');
    });
    
    
    
 // ----------------- Ride Apply Route ------------------------
    Route::controller('RideApplyController')->prefix('rides/apply')->group(function(){
        Route::get('/', 'index');
        Route::get('/{rideApply}', 'show');
        
    });

// ----------------- Ride Route ------------------------
    Route::controller('RideController')->prefix('rides')->group(function(){
        Route::get('/', 'index');
        Route::get('/{ride}', 'show');
        
    });
    
    
        
});
