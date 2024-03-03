<?php

use App\Http\Controllers\Apiproductcontroller;
use App\Http\Resources\Products;
use App\Models\Product;
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
// Route::get('products', [Apiproductcontroller::class, 'index']);
// Route::get('/products', function () {
//     return new Products(Product::all());
// });

Route::post('/Xtra-coupon/{coupon_amount}/{coupon_value}', [Apiproductcontroller::class, 'sendCoupon']);
