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

Route::middleware(['auth:sanctum'])->group(function () {

// ----------------- Auth Route ------------------------
    Route::controller('AuthController')->prefix('auth')->group(function(){
        Route::get('logout', 'logout');
    });
    
});



// without auth routes


Route::middleware([])->group(function () {

    // ----------------- Auth Route ------------------------
    Route::controller('AuthController')->prefix('auth')->group(function(){
        Route::post('login', 'login');

    });
    
});
