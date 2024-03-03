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
        Route::get('/nav-categories','NavCategoryController@get_nav');
        Route::get('/top-products','Api\ProductController@top_products');
        Route::get('/category-products/{id}/brands','Api\ProductController@category_product_brands');

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
                Route::post('/store','Auth\UserController@store');
                Route::post('/canvas-store','Auth\UserController@canvas_store');
                Route::post('/update','Auth\UserController@update');
                Route::post('/soft-delete','Auth\UserController@soft_delete');
                Route::post('/destroy','Auth\UserController@destroy');
                Route::post('/restore','Auth\UserController@restore');
                Route::post('/bulk-import','Auth\UserController@bulk_import');
                Route::get('/{id}','Auth\UserController@show');
            });

            Route::group(['prefix' => 'user-role'], function () {
                Route::get('/all','Auth\UserRoleController@all');
                Route::post('/store','Auth\UserRoleController@store');
                Route::post('/canvas-store','Auth\UserRoleController@canvas_store');
                Route::post('/update','Auth\UserRoleController@update');
                Route::post('/canvas-update','Auth\UserRoleController@canvas_update');
                Route::post('/soft-delete','Auth\UserRoleController@soft_delete');
                Route::post('/destroy','Auth\UserRoleController@destroy');
                Route::post('/restore','Auth\UserRoleController@restore');
                Route::post('/bulk-import','Auth\UserRoleController@bulk_import');
                Route::get('/{id}','Auth\UserRoleController@show');
            });

            Route::group(['prefix' => 'contact-message'], function () {
                Route::get('/all','Admin\ContactMessageController@all');
                Route::post('/store','Admin\ContactMessageController@store');
                Route::post('/canvas-store','Admin\ContactMessageController@canvas_store');
                Route::post('/update','Admin\ContactMessageController@update');
                Route::post('/canvas-update','Admin\ContactMessageController@canvas_update');
                Route::post('/soft-delete','Admin\ContactMessageController@soft_delete');
                Route::post('/destroy','Admin\ContactMessageController@destroy');
                Route::post('/restore','Admin\ContactMessageController@restore');
                Route::post('/bulk-import','Admin\ContactMessageController@bulk_import');
                Route::get('/{id}','Admin\ContactMessageController@show');
            });

            Route::group(['prefix' => 'product'], function () {
                Route::post('/store-varients','Admin\Product\ProductController@store_varients');
                Route::get('/get-varients-id','Admin\Product\ProductController@get_varients_id');

                Route::get('/all','Admin\Product\ProductController@all');
                Route::post('/store','Admin\Product\ProductController@store');
                Route::post('/canvas-store','Admin\Product\ProductController@canvas_store');
                Route::post('/update','Admin\Product\ProductController@update');
                Route::post('/update-is-top-product','Admin\Product\ProductController@update_is_top_product');
                Route::post('/delete-related-image','Admin\Product\ProductController@delete_related_image');
                Route::post('/canvas-update','Admin\Product\ProductController@canvas_update');
                Route::post('/soft-delete','Admin\Product\ProductController@soft_delete');
                Route::post('/destroy','Admin\Product\ProductController@destroy');
                Route::post('/restore','Admin\Product\ProductController@restore');
                Route::post('/bulk-import','Admin\Product\ProductController@bulk_import');
                Route::get('/{id}','Admin\Product\ProductController@show');
            });

            Route::group(['prefix' => 'product_stock'], function () {
                Route::get('/all','Admin\Product\ProductStockController@all');
                Route::post('/store','Admin\Product\ProductStockController@store');
                Route::post('/canvas-store','Admin\Product\ProductStockController@canvas_store');
                Route::post('/update','Admin\Product\ProductStockController@update');
                Route::post('/canvas-update','Admin\Product\ProductStockController@canvas_update');
                Route::post('/soft-delete','Admin\Product\ProductStockController@soft_delete');
                Route::post('/destroy','Admin\Product\ProductStockController@destroy');
                Route::post('/restore','Admin\Product\ProductStockController@restore');
                Route::post('/bulk-import','Admin\Product\ProductStockController@bulk_import');
                Route::get('/{id}','Admin\Product\ProductStockController@show');
            });

            Route::group(['prefix' => 'category'], function () {
                Route::get('/all','Admin\Product\CategoryController@all');
                Route::post('/store','Admin\Product\CategoryController@store');
                Route::post('/canvas-store','Admin\Product\CategoryController@canvas_store');
                Route::post('/update','Admin\Product\CategoryController@update');
                Route::post('/canvas-update','Admin\Product\CategoryController@canvas_update');
                Route::post('/soft-delete','Admin\Product\CategoryController@soft_delete');
                Route::post('/destroy','Admin\Product\CategoryController@destroy');
                Route::post('/restore','Admin\Product\CategoryController@restore');
                Route::post('/bulk-import','Admin\Product\CategoryController@bulk_import');
                Route::get('/all-json','Admin\Product\CategoryController@all_json');
                Route::post('/check-exists','Admin\Product\CategoryController@check_exists');
                Route::post('/add-to-top-cat','Admin\Product\CategoryController@add_to_top_cat');
                Route::get('/{id}','Admin\Product\CategoryController@show');
            });

            Route::group(['prefix' => 'brand'], function () {
                Route::get('/all','Admin\Product\BrandController@all');
                Route::post('/store','Admin\Product\BrandController@store');
                Route::post('/canvas-store','Admin\Product\BrandController@canvas_store');
                Route::post('/update','Admin\Product\BrandController@update');
                Route::post('/canvas-update','Admin\Product\BrandController@canvas_update');
                Route::post('/soft-delete','Admin\Product\BrandController@soft_delete');
                Route::post('/destroy','Admin\Product\BrandController@destroy');
                Route::post('/restore','Admin\Product\BrandController@restore');
                Route::post('/bulk-import','Admin\Product\BrandController@bulk_import');
                Route::get('/{id}','Admin\Product\BrandController@show');
            });
            Route::group(['prefix' => 'product-variant'], function () {
                Route::post('/update-title','Admin\Product\ProductVariantController@update_title');
                Route::post('/update-default-checked','Admin\Product\ProductVariantController@update_default_checked');
                Route::post('/add-new','Admin\Product\ProductVariantController@add_new');
                Route::post('/delete-value','Admin\Product\ProductVariantController@delete_value');

                Route::get('/all','Admin\Product\ProductVariantController@all');
                Route::get('/all-json','Admin\Product\ProductVariantController@all_json');
                Route::post('/store','Admin\Product\ProductVariantController@store');
                Route::post('/canvas-store','Admin\Product\ProductVariantController@canvas_store');
                Route::post('/update','Admin\Product\ProductVariantController@update');
                Route::post('/canvas-update','Admin\Product\ProductVariantController@canvas_update');
                Route::post('/soft-delete','Admin\Product\ProductVariantController@soft_delete');
                Route::post('/destroy','Admin\Product\ProductVariantController@destroy');
                Route::post('/restore','Admin\Product\ProductVariantController@restore');
                Route::post('/bulk-import','Admin\Product\ProductVariantController@bulk_import');
                Route::get('/{id}','Admin\Product\ProductVariantController@show');
            });

            Route::group(['prefix' => 'banner'], function () {
                Route::get('/all','Admin\Website\BannerController@all');
                Route::post('/store','Admin\Website\BannerController@store');
                Route::post('/canvas-store','Admin\Website\BannerController@canvas_store');
                Route::post('/update','Admin\Website\BannerController@update');
                Route::post('/toggle-status','Admin\Website\BannerController@toggle_status');
                Route::post('/canvas-update','Admin\Website\BannerController@canvas_update');
                Route::post('/soft-delete','Admin\Website\BannerController@soft_delete');
                Route::post('/destroy','Admin\Website\BannerController@destroy');
                Route::post('/restore','Admin\Website\BannerController@restore');
                Route::post('/bulk-import','Admin\Website\BannerController@bulk_import');
                Route::get('/{id}','Admin\Website\BannerController@show');
            });

            Route::group(['prefix' => 'order'], function () {
                Route::get('/all','Admin\Order\OrderController@all');
                Route::post('/update','Admin\Order\OrderController@update');
                Route::post('/canvas-update','Admin\Order\OrderController@canvas_update');
                Route::post('/soft-delete','Admin\Order\OrderController@soft_delete');
                Route::post('/destroy','Admin\Order\OrderController@destroy');
                Route::post('/restore','Admin\Order\OrderController@restore');
                Route::post('/bulk-import','Admin\Order\OrderController@bulk_import');
                Route::post('/status_update','Admin\Order\OrderController@status_update');
                Route::post('/send_emails','Admin\Order\OrderController@send_email');
                Route::post('/dashboard_info','Admin\Order\OrderController@dashboard_info');
                Route::get('/{id}','Admin\Order\OrderController@show');
            });

            Route::group(['prefix' => 'customer'], function () {
                Route::get('/all','Admin\Management\CustomerController@all');
                Route::post('/store','Admin\Management\CustomerController@store');
                Route::post('/update','Admin\Management\CustomerController@update');
                Route::post('/canvas-update','Admin\Management\CustomerController@canvas_update');
                Route::post('/soft-delete','Admin\Management\CustomerController@soft_delete');
                Route::post('/destroy','Admin\Management\CustomerController@destroy');
                Route::post('/restore','Admin\Management\CustomerController@restore');
                Route::post('/bulk-import','Admin\Management\CustomerController@bulk_import');
                Route::post('/status_update','Admin\Management\CustomerController@status_update');
                Route::post('/send_emails','Admin\Management\CustomerController@send_email');
                Route::post('/dashboard_info','Admin\Management\CustomerController@dashboard_info');
                Route::get('/{id}','Admin\Management\CustomerController@show');
            });

            Route::group(['prefix' => 'supplier'], function () {
                Route::get('/all','Admin\Management\SupplierController@all');
                Route::post('/store','Admin\Management\SupplierController@store');
                Route::post('/update','Admin\Management\SupplierController@update');
                Route::post('/canvas-update','Admin\Management\SupplierController@canvas_update');
                Route::post('/soft-delete','Admin\Management\SupplierController@soft_delete');
                Route::post('/destroy','Admin\Management\SupplierController@destroy');
                Route::post('/restore','Admin\Management\SupplierController@restore');
                Route::post('/bulk-import','Admin\Management\SupplierController@bulk_import');
                Route::post('/status_update','Admin\Management\SupplierController@status_update');
                Route::post('/send_emails','Admin\Management\SupplierController@send_email');
                Route::post('/dashboard_info','Admin\Management\SupplierController@dashboard_info');
                Route::get('/{id}','Admin\Management\SupplierController@show');
            });

            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('/dashboard_info','Admin\Order\OrderController@dashboard_info');
            });

            Route::group(['prefix' => 'settings'], function () {
                Route::get('/get','Admin\SettingController@get');
                Route::post('/update','Admin\SettingController@update');
            });

        });

        Route::get('/category/{id}/{category_name?}','Api\ProductController@category_products');
        Route::get('/{url}/{url2?}/{url3?}','Api\ProductController@category_products_by_url');
    }
);
