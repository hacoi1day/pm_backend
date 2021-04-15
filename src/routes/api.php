<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Checkin\CheckinResourceController;
use App\Http\Controllers\API\Department\DepartmentResourceController;
use App\Http\Controllers\API\Request\RequestResourceController;
use App\Http\Controllers\API\Storage\StorageController;
use App\Http\Controllers\API\User\UserResourceController;

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

// Auth Router
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // Get User
    Route::get('me', [AuthController::class, 'me']);
    // Logout
    Route::get('logout', [AuthController::class, 'logout']);

    // Storage
    Route::prefix('storage')->group(function () {
        Route::post('store-file', [StorageController::class, 'storeFile']);
    });

    // User
    Route::prefix('user')->group(function () {
        Route::resource('user', UserResourceController::class);
        Route::post('dropdown', [UserResourceController::class, 'dropdown']);
    });

    // Department
    Route::prefix('department')->group(function () {
        Route::resource('department', DepartmentResourceController::class);
        Route::post('dropdown', [DepartmentResourceController::class, 'dropdown']);
    });

    // Checkin
    Route::prefix('checkin')->group(function () {
        Route::resource('checkin', CheckinResourceController::class);
    });

    // Request
    Route::prefix('request')->group(function () {
        Route::resource('request', RequestResourceController::class);
    });

});
