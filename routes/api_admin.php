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

    // ----------------- User Route ------------------------
        // Route::controller('UserController')->prefix('users')->group(function(){
        //     Route::get('user-info', 'getUserInfo');
        //     Route::get('/profile/{user}', 'getUserProfile');
        //     Route::post('/complete-profile', 'createOrUpdateUserData');
        //     Route::put('/update-bio', 'updateUserBio');
        //     Route::post('/upload-file', 'uploadUserFile');
        //     Route::put('/update-preference/{preference}', 'updateUserPreference');     
        // });
    
    
    // ----------------- User Vehicle Route ------------------------
        // Route::controller('UserVehicleController')->prefix('vehicles/user')->group(function(){
        //     Route::post('/', 'createUserVehicle');
        //     Route::put('/{userVehicleId}', 'updateUserVehicle');
        //     Route::delete('/{userVehicleId}', 'deleteUserVehicle');
        //     Route::post('/{userVehicleId}/upload-file', 'uploadVehicleFile');     
        // });
    
    
    // ----------------- Preference Route ------------------------
        // Route::controller('PreferenceController')->prefix('preferences')->group(function(){
        //     Route::get('/', 'getPreferences'); 
        // });
    
        
    // ----------------- Review Route ------------------------
        // Route::controller('ReviewController')->prefix('reviews')->group(function(){
        //     Route::get('/received', 'getMyReceivedReviews');
        //     Route::get('/given', 'getMyGivenReviews');
        //     Route::post('/{rideId}', 'createReview');
        // });
    
    
    
    
    
    // ----------------- Chat Route ------------------------
        // Route::controller('ChatController')->prefix('chats')->group(function(){
        //     Route::get('/', 'getChatList');
        //     Route::get('/{chatId}', 'showChat');
        //     Route::delete('/{chatId}', 'deleteChat');
        // });
    
    // ----------------- Message Route ------------------------
        // Route::controller('MessageController')->prefix('messages')->group(function(){
        //     Route::get('/{chatId}', 'getMessages');
        //     Route::post('/send/{chatId}', 'sendMessage');
        //     Route::put('/update/{messageId}', 'updateMessage');
        //     Route::delete('/delete/{messageId}', 'deleteMessage');
        // });
    
    
    
    
    // ----------------- Report Route ------------------------
        // Route::controller('ReportController')->prefix('reports')->group(function(){
        //     Route::post('/', 'reportUser'); 
        // });
    
    // ----------------- Report Type Route ------------------------
        // Route::controller('ReportTypeController')->prefix('reports')->group(function(){
        //     Route::get('types', 'getReportTypes'); 
        // });
    
    
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
