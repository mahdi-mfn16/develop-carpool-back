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

// auth routes

Route::middleware('auth:sanctum')->group(function () {

// ----------------- User Route ------------------------
    Route::controller('UserController')->prefix('users')->group(function(){
        Route::get('my-info', 'getMyInfo');
        Route::post('/complete-profile', 'createOrUpdateUserData');
        Route::put('/update-bio', 'updateUserBio');
        Route::post('/upload-file', 'uploadUserFile');
        Route::put('/update-preference/{preference}', 'updateUserPreference');     
    });


// ----------------- User Vehicle Route ------------------------
    Route::controller('UserVehicleController')->middleware(['verified_user'])->prefix('vehicles/user')->group(function(){
        Route::post('/', 'createUserVehicle');
        Route::put('/{userVehicle}', 'updateUserVehicle');
        Route::delete('/{userVehicle}', 'deleteUserVehicle');
        Route::post('/{userVehicle}/upload-file', 'uploadVehicleFile');     
    });


// ----------------- Preference Route ------------------------
    Route::controller('PreferenceController')->prefix('preferences')->group(function(){
        Route::get('/', 'getPreferences'); 
    });

    
// ----------------- Review Route ------------------------
    Route::controller('ReviewController')->prefix('reviews')->group(function(){
        Route::get('/received', 'getMyReceivedReviews');
        Route::get('/given', 'getMyGivenReviews');
        Route::post('/{ride}', 'createReview')->middleware(['verified_user']);
    });





// ----------------- Chat Route ------------------------
    Route::controller('ChatController')->prefix('chats')->group(function(){
        Route::get('/', 'getChatList');
        Route::get('/{chat}', 'showChat');
        Route::delete('/{chat}', 'deleteChat')->middleware(['verified_user']);
    });

// ----------------- Message Route ------------------------
    Route::controller('MessageController')->middleware(['verified_user'])->prefix('messages')->group(function(){
        Route::get('/{chat}', 'getMessages');
        Route::post('/send/{chat}', 'sendMessage');
        Route::put('/update/{message}', 'updateMessage');
        Route::delete('/delete/{message}', 'deleteMessage');
    });


// ----------------- Report Route ------------------------
    Route::controller('ReportController')->middleware(['verified_user'])->prefix('reports')->group(function(){
        Route::post('/', 'reportUser'); 
    });




// ----------------- Ride Route ------------------------
    Route::controller('RideController')->prefix('rides')->group(function(){
        Route::get('/my-rides', 'getMyRides');
        Route::post('/', 'createRide');
        Route::get('/{ride}', 'showRide');
        Route::put('/{ride}', 'updateRide');
        Route::post('/{ride}/duplicate', 'duplicateRide');
        Route::put('/{ride}/cancel', 'cancelRide');
        
    });


// ----------------- Ride Apply Route ------------------------
    Route::controller('RideApplyController')->middleware(['verified_user'])->prefix('rides/apply')->group(function(){
        Route::post('/{ride}', 'sendRideApply');
        Route::put('/status/{rideApply}', 'updateRideApplyStatus');
        
    });
    
});



// without auth routes




Route::middleware([])->group(function () {

// ----------------- Province Route ------------------------
    Route::controller('ProvinceController')->prefix('provinces')->group(function(){
        Route::get('/', 'index');
    });


// ----------------- User Route ------------------------
    Route::controller('UserController')->prefix('users')->group(function(){
        Route::get('/user-info/{user}', 'getUserInfo');
    });


// ----------------- City Route ------------------------
    Route::controller('CityController')->prefix('cities')->group(function(){
        Route::get('/', 'index');
    });



// ----------------- Ride Route ------------------------
    Route::controller('RideController')->prefix('rides')->group(function(){
        Route::get('/', 'getAllRides');
        
    });

// ----------------- Vehicle Route ------------------------
    Route::controller('VehicleController')->prefix('vehicles')->group(function(){
        Route::get('/', 'getVehicles');
        
    });

// ----------------- Report Type Route ------------------------
    Route::controller('ReportTypeController')->prefix('reports/types')->group(function(){
        Route::get('/', 'getReportTypes'); 
    });
    
});
