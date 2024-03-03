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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['prefix' => 'v1', 'namespace' => 'Controllers'],
    function () {
        Route::group(['prefix' => '/user', 'middleware' => ['guest:api']], function () {
            Route::post('/get-token', 'Auth\ApiLoginController@get_token');
            Route::post('/api-login', 'Auth\ApiLoginController@login');
            Route::post('/api-register', 'Auth\ApiLoginController@register');
            Route::get('/auth-check', 'Auth\ApiLoginController@auth_check');
            Route::post('/forget-mail', 'Auth\ApiLoginController@forget_mail');
            Route::post('/check-code', 'Auth\ApiLoginController@check_code');
            Route::post('/logout-from-all-devices', 'Auth\ApiLoginController@logout_from_all_devices');
        });

        Route::group(['middleware' => ['auth:api']], function () {
            Route::group(['prefix' => 'user'], function () {
                Route::post('/api-logout', 'Auth\ApiLoginController@logout');
                Route::post('/user_info', 'Auth\ApiLoginController@user_info');
                Route::post('/check-auth', 'Auth\ApiLoginController@check_auth');
                Route::post('/user_update', 'Auth\ApiLoginController@user_update');
                Route::post('/update_password', 'Auth\ApiLoginController@update_password');
                Route::post('/find-user-info', 'Auth\ApiLoginController@find_user_info');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::post('/update-profile', 'Auth\ProfileController@update_profile');
                Route::get('/all','Auth\UserController@all');
                Route::get('/{id}','Auth\UserController@show');
                Route::post('/store','Auth\UserController@store');
                Route::post('/canvas-store','Auth\UserController@canvas_store');
                Route::post('/update','Auth\UserController@update');
                Route::post('/soft-delete','Auth\UserController@soft_delete');
                Route::post('/destroy','Auth\UserController@destroy');
                Route::post('/restore','Auth\UserController@restore');
                Route::post('/bulk-import','Auth\UserController@bulk_import');
            });

            Route::group(['prefix' => 'user-role'], function () {
                Route::get('/all','Auth\UserRoleController@all');
                Route::get('/{id}','Auth\UserRoleController@show');
                Route::post('/store','Auth\UserRoleController@store');
                Route::post('/canvas-store','Auth\UserRoleController@canvas_store');
                Route::post('/update','Auth\UserRoleController@update');
                Route::post('/canvas-update','Auth\UserRoleController@canvas_update');
                Route::post('/soft-delete','Auth\UserRoleController@soft_delete');
                Route::post('/destroy','Auth\UserRoleController@destroy');
                Route::post('/restore','Auth\UserRoleController@restore');
                Route::post('/bulk-import','Auth\UserRoleController@bulk_import');
            });

            Route::group(['prefix' => 'contact-message'], function () {
                Route::get('/all','Admin\ContactMessageController@all');
                Route::get('/{id}','Admin\ContactMessageController@show');
                Route::post('/store','Admin\ContactMessageController@store');
                Route::post('/canvas-store','Admin\ContactMessageController@canvas_store');
                Route::post('/update','Admin\ContactMessageController@update');
                Route::post('/canvas-update','Admin\ContactMessageController@canvas_update');
                Route::post('/soft-delete','Admin\ContactMessageController@soft_delete');
                Route::post('/destroy','Admin\ContactMessageController@destroy');
                Route::post('/restore','Admin\ContactMessageController@restore');
                Route::post('/bulk-import','Admin\ContactMessageController@bulk_import');
            });

        });
    }
);
