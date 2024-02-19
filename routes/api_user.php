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
        Route::get('user-info', 'getUserInfo');
        Route::get('/profile/{user}', 'getUserProfile');
        Route::post('/complete-profile', 'createOrUpdateUserData');
        Route::put('/update-bio', 'updateUserBio');
        Route::post('/upload-file', 'uploadUserFile');
        Route::put('/update-preference/{preference}', 'updateUserPreference');     
    });


// ----------------- User Vehicle Route ------------------------
    Route::controller('UserVehicleController')->middleware(['verified_user'])->prefix('vehicles/user')->group(function(){
        Route::post('/', 'createUserVehicle');
        Route::put('/{userVehicleId}', 'updateUserVehicle');
        Route::delete('/{userVehicleId}', 'deleteUserVehicle');
        Route::post('/{userVehicleId}/upload-file', 'uploadVehicleFile');     
    });


// ----------------- Preference Route ------------------------
    Route::controller('PreferenceController')->prefix('preferences')->group(function(){
        Route::get('/', 'getPreferences'); 
    });

    
// ----------------- Review Route ------------------------
    Route::controller('ReviewController')->prefix('reviews')->group(function(){
        Route::get('/received', 'getMyReceivedReviews');
        Route::get('/given', 'getMyGivenReviews');
        Route::post('/{rideId}', 'createReview')->middleware(['verified_user']);
    });





// ----------------- Chat Route ------------------------
    Route::controller('ChatController')->prefix('chats')->group(function(){
        Route::get('/', 'getChatList');
        Route::get('/{chatId}', 'showChat');
        Route::delete('/{chatId}', 'deleteChat')->middleware(['verified_user']);
    });

// ----------------- Message Route ------------------------
    Route::controller('MessageController')->middleware(['verified_user'])->prefix('messages')->group(function(){
        Route::get('/{chatId}', 'getMessages');
        Route::post('/send/{chatId}', 'sendMessage');
        Route::put('/update/{messageId}', 'updateMessage');
        Route::delete('/delete/{messageId}', 'deleteMessage');
    });




// ----------------- Report Route ------------------------
    Route::controller('ReportController')->middleware(['verified_user'])->prefix('reports')->group(function(){
        Route::post('/', 'reportUser'); 
    });

// ----------------- Report Type Route ------------------------
    Route::controller('ReportTypeController')->prefix('reports')->group(function(){
        Route::get('types', 'getReportTypes'); 
    });


// ----------------- Ride Route ------------------------
    Route::controller('RideController')->prefix('rides')->group(function(){
        Route::get('/my-rides', 'getMyRides');
        
    });


// ----------------- Ride Apply Route ------------------------
    Route::controller('RideApplyController')->middleware(['verified_user'])->prefix('rides/apply')->group(function(){
        Route::post('/{rideId}', 'sendRideApply');
        Route::put('/status/{rideApplyId}', 'updateRideApplyStatus');
        
    });
    
});



// without auth routes




Route::middleware([])->group(function () {

// ----------------- Province Route ------------------------
    Route::controller('ProvinceController')->prefix('provinces')->group(function(){
        Route::get('/', 'index');
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
    
});
