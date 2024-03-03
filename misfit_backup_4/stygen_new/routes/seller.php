<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\UserController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\BrandController;
use App\Http\Controllers\Seller\CustomerController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\Auth\RegisterController;
use App\Http\Controllers\Seller\Auth\ForgotPasswordController;
use App\Http\Controllers\Seller\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login----------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('seller.login');
Route::post('/login', [LoginController::class, 'login'])->name('seller.login.post');
Route::post('/register-seller', [UserController::class, 'sellerRegister'])->name('seller.register.post');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('seller.password.email');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('seller.password.update');

Route::group(['middleware' => 'auth:seller'], function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('seller.dashboard');

    //Seller Details---------------------
    Route::get('seller-details', [UserController::class, 'seller_details'])->name('seller.seller_details');
    Route::get('get-seller-details', [UserController::class, 'get_seller_details'])->name('seller.get_seller_details');

    //Category
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('category', \Seller\CategoryController::class);
    });

    Route::post('category-update', [CategoryController::class, 'update'])->name('seller.categoriesUpdate');
    Route::post('multiple-category-delete', [CategoryController::class, 'multipleCategoryDelete'])->name('seller.multipleCategoryDelete');
    Route::get('categories-list', [CategoryController::class, 'categoriesList'])->name('seller.categoriesList');
    Route::get('get-all-categories', [CategoryController::class, 'getAllCategories'])->name('seller.getAllCategories');
    Route::get('/search-category', [CategoryController::class, 'searchCategory'])->name('seller.searchCategory');

    //Brand
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('brand', \Seller\BrandController::class);
    });

    Route::post('multiple-brand-delete', [BrandController::class, 'multipleBrandDelete'])->name('seller.multipleBrandDelete');
    Route::get('brands-list', [BrandController::class, 'brandsList'])->name('seller.brandsList');
    Route::get('/search-brand', [BrandController::class, 'searchBrand'])->name('seller.searchBrand');

    //Customer

    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('customer', \Seller\CustomerController::class);
    });

    Route::post('multiple-customer-delete', [CustomerController::class, 'multipleCustomerDelete'])->name('seller.multipleCustomerDelete');

    //Attribute

    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('attribute', \Seller\AttributeController::class);
    });

    Route::post('multiple-attribute-delete', [AttributeController::class, 'multipleAttributeDelete'])->name('seller.multipleAttributeDelete');
    Route::get('attribute-name-list', [AttributeController::class, 'attributeNameList'])->name('seller.attributeNameList');
    Route::get('/search-attribute', [AttributeController::class, 'searchAttribute'])->name('seller.searchAttribute');

    //Product
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('product', \Seller\ProductController::class);
    });
    // Route::resource('product', ProductController::class);
    Route::post('multiple-product-delete', [ProductController::class, 'multipleProductDelete'])->name('seller.multipleProductDelete');
    Route::get('all-products', [ProductController::class, 'all_products'])->name('seller.all_products');
    Route::post('product-attribute', [ProductController::class, 'getProAttribute'])->name('seller.getProAttribute');
    Route::get('get-product-attributes', [ProductController::class, 'getProductAttributes'])->name('seller.getProductAttributes');
    Route::post('/product/{id}', [ProductController::class, 'update'])->name('seller.productUpdate');
    Route::post('/product-duplicate/{id}', [ProductController::class, 'duplicate'])->name('seller.productDuplicate');
    Route::get('/shippings-charge', [ProductController::class, 'shippingCharge'])->name('seller.shippingCharge');
    Route::post('/product-upload', [ProductController::class, 'uploadProduct'])->name('seller.uploadProduct');
    Route::get('/search-product', [ProductController::class, 'searchSellerProduct'])->name('seller.searchSellerProduct');
    Route::post('/product-status-update', [ProductController::class, 'productStatusChange'])->name('seller.productStatusChange');
    Route::post('/product-stock-update', [ProductController::class, 'productStockUpdate'])->name('seller.productStockUpdate');

    //Order
    Route::get('order-list', [OrderController::class, 'orders'])->name('seller.orders');
    Route::get('order-details/{id}', [OrderController::class, 'orders_details'])->name('seller.orders_details');
    Route::get('get-shipping-status', [OrderController::class, 'getShippingStatus'])->name('seller.getShippingStatus');
    Route::post('order-status-update', [OrderController::class, 'orderStatusChange'])->name('seller.orderStatusChange');
    Route::get('/search-order', [OrderController::class, 'searchSellerOrder'])->name('seller.searchSellerOrder');

    //Invoice Download
    Route::get('invoice-download/{id}', [OrderController::class, 'invoiceUserDownload'])->name('invoiceUserDownload');
    // checkout,purchasae, cart

    //Logout--------------
    Route::get('/logout', [LoginController::class, 'logout'])->name('seller.logout');
});


//For Seller Any Path
Route::get('/{path}', [UserController::class, 'index'])->name('seller.basepath');

//For Seller Any Path for ID
Route::get('/{path}/{id}', [UserController::class, 'index'])->name('seller.basepath');
