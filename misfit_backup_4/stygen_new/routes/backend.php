<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ShippingChargeController;
use App\Http\Controllers\Backend\OccasionController;
use App\Http\Controllers\Backend\RecipientController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PackagingController;
use App\Http\Controllers\Backend\CardController;
use App\Models\Product;
use App\Models\StockLedger;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login----------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');

Route::group(['middleware' => 'auth:admin'], function(){
    Route::get('/', [UserController::class, 'index'])->name('admin.dashboard');

    //Dashboard
    Route::get('sale-by-category', [DashboardController::class, 'sale_by_categories'])->name('admin.sale_by_categories');
    Route::get('sale-by-product', [DashboardController::class, 'sale_by_products'])->name('admin.sale_by_products');
    Route::get('sale-by-seller', [DashboardController::class, 'sale_by_sellers'])->name('admin.sale_by_sellers');
    Route::get('weekly_user',[DashboardController::class, 'weekly_user'])->name('admin.weekly_user');
    // Route::get('daily-order',[DashboardController::class, 'daily_order'])->name('admin.daily_order');

    Route::get('daily_order', [DashboardController::class, 'daily_order'])->name('admin.daily_order');
    Route::get('monthly_order', [DashboardController::class, 'monthly_order'])->name('admin.monthly_order');
    Route::post('custom_order',[DashboardController::class, 'custom_order'])->name('admin.custom_order');

    //Admin Details---------------------
    Route::get('admin-details', [UserController::class, 'admin_details']);
    Route::get('get-admin-details', [UserController::class, 'get_admin_details']);

    //Subscribe List
    Route::get('subscribe-list', [UserController::class, 'subscribeList']);

    //Brand
    // Route::resource('brand', BrandController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('brand', \Backend\BrandController::class);
    });
    Route::get('brands-list', [BrandController::class, 'brandsList'])->name('admin.brandsList');

    //Shipping Charge

    // Route::resource('shippings-charge', ShippingChargeController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('shippings-charge', \Backend\ShippingChargeController::class);
    });
    Route::post('multiple-shippings-charge-delete', [ShippingChargeController::class, 'multipleShippingChargeDelete'])->name('admin.multipleShippingChargeDelete');

    //Coupon
    // Route::resource('coupon', CouponController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('coupon', \Backend\CouponController::class);
    });
    Route::get('coupon_user_list', [CouponController::class, 'coupon_users']);
    Route::post('multiple-coupon-delete', [CouponController::class, 'multipleCouponDelete'])->name('admin.multipleCouponDelete');

    //Packaging
    // Route::resource('packaging', PackagingController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('packaging', \Backend\PackagingController::class);
    });
    //Packaging
    // Route::resource('card', CardController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('card', \Backend\CardController::class);
    });
    //Seller List
    Route::get('seller-lists', [CompanyInfoController::class, 'sellerList'])->name('admin.sellerList');
    Route::post('seller-approve', [CompanyInfoController::class, 'sellerApprove'])->name('admin.sellerApprove');
    Route::post('multiple-seller-approve', [CompanyInfoController::class, 'multipleSellerApprove'])->name('admin.multipleSellerApprove');

    //Occasion
    // Route::resource('occasion', OccasionController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('occasion', \Backend\OccasionController::class);
    });

    Route::post('occasion-update', [OccasionController::class, 'update'])->name('admin.occasion.update');
    Route::post('multiple-occasion-delete', [OccasionController::class, 'multipleOccasionDelete'])->name('admin.multipleOccasionDelete');
    Route::get('/get-all-occasion', [OccasionController::class, 'getAllOccasion'])->name('admin.getAllOccasion');
    Route::get('/occassion-products', [OccasionController::class, 'getOccasionProducts'])->name('admin.getOccasionProducts');
    Route::get('/occassion-product-list', [OccasionController::class, 'occassionProductList'])->name('admin.occassionProductList');
    Route::post('/occassion-product-visibility', [OccasionController::class, 'occassionProductVisibility'])->name('admin.occassionProductVisibility');
    Route::get('/search-occassion-product', [OccasionController::class, 'searchOccassionProduct'])->name('admin.searchOccassionProduct');
    Route::get('/category-wise-product', [OccasionController::class, 'catOccasionWiseProduct'])->name('admin.catOccasionWiseProduct');
    Route::get('/category-wise-productids', [OccasionController::class, 'catOccasionWiseProductIds'])->name('admin.catOccasionWiseProductIds');
    Route::post('/occassion-wise-product-update', [OccasionController::class, 'occassionWiseProductUpdate'])->name('admin.occassionWiseProductUpdate');

    //Recipient
    // Route::resource('recipient', RecipientController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('recipient', \Backend\RecipientController::class);
    });

    Route::post('recipient-update', [RecipientController::class, 'update'])->name('admin.recipient.update');
    Route::post('multiple-recipient-delete', [RecipientController::class, 'multipleRecipientDelete'])->name('admin.multipleRecipientDelete');

    //Slider
    // Route::resource('slider', SliderController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('slider', \Backend\SliderController::class);
    });
    Route::post('slider-update', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::post('multiple-slider-delete', [SliderController::class, 'multipleSliderDelete'])->name('admin.multipleSliderDelete');

    //Category
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('category', \Backend\CategoryController::class);
    });
    Route::post('category-update', [CategoryController::class, 'update'])->name('admin.categoriesUpdate');
    Route::post('multiple-category-delete', [CategoryController::class, 'multipleCategoryDelete'])->name('admin.multipleCategoryDelete');
    Route::get('categories-list', [CategoryController::class, 'categoriesList'])->name('admin.categoriesList');
    Route::get('get-all-categories', [CategoryController::class, 'getAllCategories'])->name('admin.getAllCategories');

    //Product
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('product', \Backend\ProductController::class);
    });
    Route::post('product-update/{id}', [ProductController::class, 'update'])->name('admin.update');
    Route::post('multiple-product-delete', [ProductController::class, 'multipleProductDelete'])->name('admin.multipleProductDelete');
    Route::get('/search-product', [ProductController::class, 'searchSellerProduct'])->name('admin.searchSellerProduct');
    Route::get('/search-addon-product',[ProductController::class, 'searchAddonProduct'])->name('admin.searchAddonProduct');
    Route::get('/get-all-seller', [ProductController::class, 'getAllSellers'])->name('admin.getAllSellers');
    Route::get('/category-product', [ProductController::class, 'catProFilter'])->name('admin.catProFilter');
    Route::get('/seller-product-filter', [ProductController::class, 'sellerProFilter'])->name('admin.sellerProFilter');
    Route::get('/product-stock-filter', [ProductController::class, 'proStockFilter'])->name('admin.proStockFilter');
    Route::post('/product-status-update', [ProductController::class, 'productStatusChange'])->name('admin.productStatusChange');
    Route::get('/add-on-products',[ProductController::class, 'get_product_addon_ids'])->name('admin.get_product_addon_ids');
    Route::post('/product-add_on-update', [ProductController::class, 'productAddonChange'])->name('admin.productAddonChange');
    Route::post('/product-add_on-edit/{id}', [ProductController::class, 'productAddonUpdate'])->name('admin.productAddonUpdate');
    Route::post('/product-add_on-delete/{id}', [ProductController::class, 'addonDelete'])->name('admin.addonDelete');

    // Route::get('/low-stock-products', [ProductController::class, 'lowstockproduct'])->name('admin.lowstockproduct');
    Route::get('low-stock-products', [ProductController::class, 'lowstockproduct'])->name('admin.lowstockproduct');
    Route::get('low-stock-count', [ProductController::class, 'low_stock_count'])->name('admin.low_stock_count');



    Route::get('campaign-userlist',[UserController::class, 'campaign_user'])->name('admin.campaign_user');

    Route::get('/get-addon-products', [ProductController::class, 'productAddonList'])->name('admin.productAddonList');
    Route::get('/get-all-products',[ProductController::class, 'get_addon_products'])->name('admin.get_addon_products');
    Route::get('/show-addon-products/{id}',[ProductController::class, 'show_addon_product'])->name('admin.show_addon_product');

    //Junior-project
    Route::post('junior-form-submit', [UserController::class, 'juniorFormSubmit'])->name('admin.juniorFormSubmit');
    Route::get('/junior_project_data', [UserController::class, 'junior_project']);



    //Attribute
    Route::prefix('')->namespace('Controllers')->group(function () {
        // Route::resource('slider', \Backend\SliderController::class);
        Route::resource('attribute', \Backend\AttributeController::class);
    });

    Route::post('multiple-attribute-delete', [AttributeController::class, 'multipleAttributeDelete'])->name('seller.multipleAttributeDelete');
    Route::get('get-product-attributes', [ProductController::class, 'getProductAttributes'])->name('admin.getProductAttributes');


    //Blog
    // Route::resource('blog', BlogController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('blog', \Backend\BlogController::class);
    });
    Route::post('blog-update', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::post('multiple-blog-delete', [BlogController::class, 'multipleBlogDelete'])->name('admin.multipleBlogDelete');

    //Order
    Route::get('order-list', [OrderController::class, 'orders'])->name('admin.orders');
    Route::get('order-details/{id}', [OrderController::class, 'orders_details'])->name('admin.orders_details');
    Route::get('get-shipping-status', [OrderController::class, 'getShippingStatus'])->name('admin.getShippingStatus');
    Route::post('order-status-update', [OrderController::class, 'orderStatusChange'])->name('admin.orderStatusChange');
    Route::get('/search-order', [OrderController::class, 'searchAdminOrder'])->name('admin.searchAdminOrder');

    Route::get('/search-coupon', [OrderController::class, 'couponsearch'])->name('admin.couponsearch');

    Route::post('order-note-update', [OrderController::class, 'orderNoteUpdate'])->name('admin.orderNoteUpdate');

    Route::get('/last-month-order',[OrderController::class, 'last_month_order'])->name('admin.last_month_order');
    Route::get('/all-customers',[OrderController::class, 'all_customers'])->name('admin.all_customers');

    //Invoice Download
    Route::get('admin-invoice-download/{id}', [OrderController::class, 'AdmininvoiceDownload'])->name('AdmininvoiceDownload');

    //Company Info

    // Route::resource('company-info', CompanyInfoController::class);
    Route::prefix('')->namespace('Controllers')->group(function () {
        Route::resource('company-info', \Backend\CompanyInfoController::class);
    });
    Route::post('company-info-update', [CompanyInfoController::class, 'update'])->name('admin.company_info.update');
    Route::post('multiple-company-info-delete', [CompanyInfoController::class, 'multipleCompanyInfoDelete'])->name('admin.multipleCompanyInfoDelete');

    //Logout--------------
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Shipping Charge
    Route::get('/seller-shippings-charge', [ProductController::class, 'shippingCharge'])->name('admin.shippingCharge');
});

//Landing Page Slider
Route::get('get-all-slider', [SliderController::class, 'getAllSlider'])->name('admin.getAllSlider');
Route::get('get-single-slider', [SliderController::class, 'getSingleSlider'])->name('admin.getSingleSlider');


//For Backend Any Path
Route::get('/{path}', [UserController::class, 'index'])->name('admin.basepath');

//For Backend Any Path for ID
// Route::get('/{path}/{id}', [UserController::class, 'index'])->name('admin.basepath');
