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
    Route::controller('UserVehicleController')->prefix('vehicles/user')->group(function(){
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
        Route::post('/{rideId}', 'createReview');
    });





// ----------------- Chat Route ------------------------
    // Route::controller('ChatController')->prefix('chats')->group(function(){
    //     Route::get('/', 'getUserChatList');
    //     Route::post('/user-chat', 'showOneUserChat');
    //     Route::post('/{chat}', 'showOneChat');
    //     Route::delete('/{chat}', 'deleteChat');
    // });

// ----------------- Message Route ------------------------
    // Route::controller('MessageController')->prefix('messages')->group(function(){
    //     Route::post('/', 'getUserAllMessages');
    //     Route::post('/send', 'sendMessage');
    //     Route::post('/send-default', 'sendDefaultMessage');
    //     Route::get('/default', 'getDefaultMessages');
    //     Route::put('/update/{message}', 'updateMessage');
    //     Route::delete('/delete/{message}', 'deleteMessage');
    // });




// ----------------- Report Route ------------------------
    Route::controller('ReportController')->prefix('reports')->group(function(){
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


// ----------------- User Route ------------------------
    Route::controller('UserController')->prefix('users')->group(function(){
        Route::post('/send-code', 'sendCode');
        Route::post('/check-code', 'checkUserCode');
        
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
