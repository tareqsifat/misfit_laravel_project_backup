<?php

use App\Http\Controllers\FbapiController;
use App\Http\Controllers\Frontend\BkashController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Payment\CashOnDeliveryController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\MailchimpController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;
use App\Mail\TestMail;
use App\Mail\welcome;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Cpanel Codes Cache Clear
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'DONE'; //Return anything
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});

Route::get('/view-cache', function() {
    $exitCode = Artisan::call('view:cache');
    return 'DONE'; //Return anything
});

Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'DONE'; //Return anything
});

// clear config files
Route::get('/clear-config-cache', function() {
    Artisan::call('config:clear');
    return "Configuration cache file removed";
});

Route::get('/send-mail', function () {
    Mail::to('sajid.stygen@gmail.com')->send(new welcome());
    return view('email.welcome');
});


//Admin Route Path Linkup
Route::prefix('admin')->group(base_path('routes/backend.php'));

//Frontend Route Path Linkup
Route::prefix('user')->group(base_path('routes/frontend.php'));

//Seller Route Path Linkup
Route::prefix('seller')->group(base_path('routes/seller.php'));

Auth::routes();

// Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/mailchimp_add_store', [MailchimpController::class, 'addstore']);
Route::get('/mailchimp_addproduct', [MailchimpController::class, 'addproducts']);
Route::get('/mailchimp_products',[MailchimpController::class, 'products']);
Route::get('/mailchimp_products_delete',[MailchimpController::class, 'delete_products']);
Route::get('/mailchimp_customers',[MailchimpController::class, 'customer']);
Route::get('/subscriber_list',[MailchimpController::class, 'sublist']);

Route::get('login', [UserController::class, 'index'])->name('login');
Route::get('register', [UserController::class, 'index'])->name('register');

Route::post('custom_register', [UserController::class, 'custom_register'])->name('custom_register');

Route::post('claim-gift', [UserController::class, 'claim_gift'])->name('claim-gift');


Route::post('login-otp', [UserController::class, 'loginOtp'])->name('loginOtp');
Route::post('login-otp-confirm', [UserController::class, 'loginOtpConfirm'])->name('loginOtpConfirm');

Route::post('/fbapi',[FbapiController::class, 'fbapi'])->name('fbapi');
//Route::get('/home', [UserController::class, 'index']);

// Route::get('/', function () {
//     // $products = Product::select('id', 'product_name', 'pro_slug', 'featured_image', 'short_description','regular_price', 'sales_price','product_sku')
//     // ->where('status', 1)->get();
//     // $brands = Brand::select('id', 'brand_name')->where('status', 1)->get();
//     return view('frontend.frontend_master');
// });



Route::get('chart', [UserController::class, 'chart'])->name('chart');

// clear false orders
Route::get('clear_order', [UserController::class, 'clear_order'])->name('clear_order');
Route::post('clear_order_confirm', [UserController::class, 'clear_order_confirm'])->name('clear_order_confirm');

Route::get('monthly_chart', [UserController::class, 'monthly_chart'])->name('monthly_chart');
Route::get('hour_chart', [UserController::class, 'hour_chart'])->name('hour_chart');
//Product Feed XML
Route::get('product-feed.xml', [ProductController::class, 'product_feed']);
Route::get('product-feed', [ProductController::class, 'product_feed_view']);
// Route::get('product_meta',[ProductController::class, 'meta']);

//Sitemap
Route::get('sitemap.xml', [UserController::class, 'sitemap']);
Route::get('category-sitemap.xml', [UserController::class, 'category_sitemap']);
Route::get('blog/blog-sitemap.xml', [UserController::class, 'blog_sitemap']);

//Products
Route::get('product-list', [ProductController::class, 'index']);
Route::get('category-product-list', [ProductController::class, 'category_product']);
Route::post('category-product-slug', [ProductController::class, 'category_product_slug']);
Route::get('occasion-product-list', [ProductController::class, 'occasion_product']);
Route::get('brand-product-list', [ProductController::class, 'brand_product']);
Route::post('occasion-product-slug', [ProductController::class, 'occasion_product_slug']);
Route::get('single-product/{slug}', [ProductController::class, 'single_product']);
Route::get('related-product/{slug}', [ProductController::class, 'related_product']);
Route::get('addon-product/{slug}', [ProductController::class, 'addon_product']);
Route::get('trending-product', [ProductController::class, 'trending_product']);
Route::post('/single-product-category', [ProductController::class, 'singleProductCategory']);
Route::post('/product-view-by-user', [ProductController::class, 'singleProductView']);
Route::post('/product-category-name', [ProductController::class, 'productCategoryName']);
Route::post('/product-occassion-name', [ProductController::class, 'productOccassionName']);
Route::post('/product-brand-name', [ProductController::class, 'productBrandName']);
Route::get('/sort-product', [ProductController::class, 'sortProduct']);
Route::get('/sort-category-product', [ProductController::class, 'categoryProductSort']);
Route::get('/sort-occassion-product', [ProductController::class, 'occassionProductSort']);
Route::post('/get-view-content', [ProductController::class, 'getViewContent'])->name('getViewContent');
Route::get('get-all-variations', [ProductController::class, 'getAllVariations']);
Route::get('product-variation-filer', [ProductController::class, 'filterByVariation']);
Route::get('search-product', [ProductController::class, 'searchProduct']);
Route::get('get-landing-categories', [UserController::class, 'getLandingCategories']);
Route::post('ocassion-product-category', [ProductController::class, 'occasion_product_categories']);
Route::post('occassion-product-filter', [ProductController::class, 'ocassion_product_filter']);

Route::post('get-product-stock', [ProductController::class, 'singleProductQuantity']);
// Cart Section
Route::group(['prefix' => 'cart'], function (){
    Route::post('add-to-cart',  [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('product-list',  [CartController::class, 'cartProductList'])->name('cartProductList');
    Route::get('remove-cart-product/{id}',  [CartController::class, 'removeCartProduct'])->name('removeCartProduct');
    Route::post('update-cart',  [CartController::class, 'updateCart'])->name('updateCart');
});

//Browse Category
Route::get('browse-categories-list', [ProductController::class, 'browseCategoryList'])->name('browseCategoryList');

//Get ALL ccasion Gift
Route::get('get-all-occasion', [UserController::class, 'getAllOccasion'])->name('getAllOccasion');
Route::get('get-all-landing-occasion', [UserController::class, 'getAllOccasionLanding'])->name('getAllOccasionLanding');

//Get All Brands
Route::get('get-all-landing-brand', [UserController::class, 'getAllBrandLanding'])->name('getAllBrandLanding');


//Get ALL Recipient
Route::get('get-all-recipient', [UserController::class, 'getAllRecipient'])->name('getAllRecipient');

//Get Variations Count
Route::post('get-variations', [ProductController::class, 'getVariations'])->name('getVariations');

// Cash On Delivery Section
Route::post('cash-on-delivery', [CashOnDeliveryController::class, 'cashOnDelivery'])->name('cashOnDelivery');
Route::post('get-purchase-record', [CashOnDeliveryController::class, 'getPurchaseRecord'])->name('getPurchaseRecord');

//Orders
Route::get('orders-list', [OrderController::class, 'orders'])->name('orders');

//Coompany Info
Route::get('/landing-company-info', [UserController::class, 'landingCompanyInfo'])->name('landingCompanyInfo');

//Blog Section
Route::get('get-all-blog', [BlogController::class, 'getAllBlog'])->name('getAllBlog');
Route::get('single-blog/{slug}', [BlogController::class, 'getSingleBlog'])->name('getSingleBlog');
Route::post('single-blog-name', [BlogController::class, 'getSingleBlogName'])->name('getSingleBlogName');
Route::get('blog-products/{slug}',[BlogController::class, 'blog_product'])->name('blog_product');
Route::get('blog/{slug}',[BlogController::class, 'getSingleBlog'])->name('getSingleBlog');


Route::get('bkash_payment',[BkashController::class, 'visit']);
// Route::post('token', [BkashController::class, 'token'])->name('token');
Route::post('createpayment', [BkashController::class, 'createpayment'])->name('createpayment');
Route::post('executepayment', [BkashController::class, 'executepayment'])->name('executepayment');
// Route::get('/thank-you', [BkashController::class, 'thank_you'])->name('thanks');
Route::get('/failed', [BkashController::class, 'failed'])->name('failed');

Route::post('order_data_bkash',[BkashController::class, 'order_data']);

Route::post('bkash_refund',[BkashController::class, 'refund']);
Route::post('bkash_refund_status',[BkashController::class, 'refund_status']);
Route::get('bkash_token', [BkashController::class, 'bkash_Get_Token']);

//Subscribe
Route::post('user-subscribe', [UserController::class, 'userSubscribe'])->name('userSubscribe');
Route::post('popup-form', [UserController::class, 'popup'])->name('popup');

//Checkout Shipping Charge
Route::get('shippings-charge-checkout', [UserController::class, 'checkoutShippingCharge'])->name('checkoutShippingCharge');
Route::post('get-shipping-charge', [UserController::class, 'getShippingCharge'])->name('getShippingCharge');

//Checkout Packaging
Route::get('/checkout-packaging', [UserController::class, 'checkout_packaging_list'])->name('checkout_packaging_list');

//Checkout Greetings Card
Route::get('/checkout-greetings-card', [UserController::class, 'checkout_greetings_card'])->name('checkout_greetings_card');

// Coupon Section
Route::post('apply-coupon', [CouponController::class, 'apply_coupon'])->name('apply_coupon');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//For Frontend Any Path
Route::get('/{path}', [UserController::class, 'index']);

//For Frontend Any Path for ID
Route::get('/{path}/{id}', [UserController::class, 'index']);

//For Frontend Any Path for ID
Route::get('/{path}/{path2}/{id}', [UserController::class, 'index']);
