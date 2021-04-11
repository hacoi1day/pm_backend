<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Department\DepartmentResourceController;
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

    // User
    Route::prefix('user')->group(function () {
        Route::resource('user', UserResourceController::class);
    });

    // Department
    Route::prefix('department')->group(function () {
        Route::resource('department', DepartmentResourceController::class);
    });


});
