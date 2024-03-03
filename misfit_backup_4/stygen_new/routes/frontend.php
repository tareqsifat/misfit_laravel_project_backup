<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\OrderController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [UserController::class, 'index']);


    //User Details---------------------
    Route::get('user-details', [UserController::class, 'user_details']);
    Route::get('get-user-details', [UserController::class, 'get_user_details']);

    //Update User Address
    Route::post('update-address', [UserController::class, 'updateAddress']);

    //Wishlist
    Route::resource('wishlist', WishlistController::class);

    //Review
    Route::post('product-review', [UserController::class, 'productReview'])->name('productReview');

    //Invoice Download
    Route::get('invoice-download/{id}', [OrderController::class, 'invoiceDownload'])->name('invoiceDownload');
});

//For Frontend Any Path
Route::get('/{path}', [UserController::class, 'index']);

//For Frontend Any Path for ID
Route::get('/{path}/{id}', [UserController::class, 'index']);
