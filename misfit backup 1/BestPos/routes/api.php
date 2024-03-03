<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Auth\ApiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\DomainController;
use \App\Http\Controllers\PlanFeatureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//not auth routese
Route::group(['prefix' => '/user'], function () {
    Route::get('/auth-check/{guard}', [ApiLoginController::class,'auth_check']);
    Route::post('/logout-from-all-devices', [ApiLoginController::class,'logout_from_all_devices']);
});


Route::group(['prefix' => 'user'], function () {
    Route::post('/user_update', [ApiLoginController::class,'user_update']);
    Route::post('/update_password', [ApiLoginController::class,'update_password']);
});


// Admin Routes
Route::post('login_to_the_system', [AdminAuthController::class, 'login']);
Route::post('admin_logout', [AdminAuthController::class, 'logout']);
Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin'
], function(){
    Route::apiResource('admin', AdminController::class);
    Route::apiResource('plan_feature', PlanFeatureController::class);
    Route::apiResource('pricing_plan', \App\Http\Controllers\PricingPlanController::class);
    Route::put('add_feature_to_plan/{id}', [\App\Http\Controllers\PricingPlanController::class, 'addFeatureToPlan']);

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::delete('delete/{id}','destroy');
        Route::put('/block/{id}','blockUser');
        Route::put('/unblock/{id}','unblockUser');
        Route::get('/blocked','blockedUsers');
    });
    Route::apiResource('domains', DomainController::class);
});
