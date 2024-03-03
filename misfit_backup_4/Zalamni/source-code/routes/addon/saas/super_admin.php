<?php

use App\Http\Controllers\addon\saas\frontend\ContactUsController;
use App\Http\Controllers\addon\saas\super_admin\CorePagesSettingController;
use App\Http\Controllers\addon\saas\super_admin\CustomDomainRequestController;
use App\Http\Controllers\addon\saas\super_admin\CustomerController;
use App\Http\Controllers\addon\saas\super_admin\FaqController;
use App\Http\Controllers\addon\saas\super_admin\FeaturesController;
use App\Http\Controllers\addon\saas\super_admin\FrontendController;
use App\Http\Controllers\addon\saas\super_admin\HowItsWorkController;
use App\Http\Controllers\addon\saas\super_admin\PackageController;
use App\Http\Controllers\addon\saas\super_admin\SubscriptionController;
use App\Http\Controllers\addon\saas\super_admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Alumni\NotificationController;
use App\Http\Controllers\SuperAdmin\SettingController as SuperAdminSettingController;
use Illuminate\Support\Facades\Route;

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

Route::get('customer-list', [CustomerController::class, 'list'])->name('customer_list');
Route::post('customer_delete/{id}', [CustomerController::class, 'delete'])->name('customer_delete');
Route::get('customer_edit/{id}', [CustomerController::class, 'edit'])->name('customer_edit');
Route::post('customer_update/{id}', [CustomerController::class, 'update'])->name('customer_update');
Route::get('customer_details/{id}', [CustomerController::class, 'details'])->name('customer_details');

Route::group(['prefix' => 'packages', 'as' => 'packages.'], function () {
    Route::get('/', [PackageController::class, 'index'])->name('index');
    Route::get('edit/{id}', [PackageController::class, 'edit'])->name('edit');
    Route::post('store', [PackageController::class, 'store'])->name('store');
    Route::post('destroy/{id}', [PackageController::class, 'destroy'])->name('destroy');
    Route::get('user', [PackageController::class, 'userPackage'])->name('user');
    Route::post('assign', [PackageController::class, 'assignPackage'])->name('assign');
});

//user-Subscription
Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], function () {
    Route::get('orders', [SubscriptionController::class, 'orders'])->name('orders');
    Route::get('orders/get-info', [SubscriptionController::class, 'orderGetInfo'])->name('orders.get.info'); // ajax
    Route::post('orders/payment-status-change', [SubscriptionController::class, 'orderPaymentStatusChange'])->name('order.payment.status.change');
    Route::get('orders-payment-status', [SubscriptionController::class, 'ordersStatus'])->name('orders.payment.status'); // ajax
});
Route::group(['prefix' => 'frontend-setting', 'as' => 'frontend-setting.'], function () {

    Route::get('/', [FrontendController::class, 'frontendSectionIndex'])->name('index');
    Route::get('section-setting', [FrontendController::class, 'sectionSettingIndex'])->name('section.index');
    Route::get('section-info/{id}', [FrontendController::class, 'frontendSectionInfo'])->name('section.info');
    Route::post('section-update', [FrontendController::class, 'frontendSectionUpdate'])->name('section.update');
    Route::post('application-settings-update', [SettingController::class, 'applicationSettingUpdate'])->name('application-settings.update');

    // how-its-work start
    Route::group(['prefix' => 'how-its-works', 'as' => 'how-its-works.'], function () {
        Route::get('/', [HowItsWorkController::class, 'index'])->name('index');
        Route::post('store', [HowItsWorkController::class, 'store'])->name('store');
        Route::post('delete/{id}', [HowItsWorkController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [HowItsWorkController::class, 'edit'])->name('edit');
    });

    // features start
    Route::group(['prefix' => 'features', 'as' => 'features.'], function () {
        Route::get('/', [FeaturesController::class, 'index'])->name('index');
        Route::post('store', [FeaturesController::class, 'store'])->name('store');
        Route::post('delete/{id}', [FeaturesController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [FeaturesController::class, 'edit'])->name('edit');
    });

    // core-page
    Route::group(['prefix' => 'core-page', 'as' => 'core-page.'],function () {
        Route::get('', [CorePagesSettingController::class, 'index'])->name('index');
        Route::post('store', [CorePagesSettingController::class, 'store'])->name('store');
        Route::post('delete/{id}', [CorePagesSettingController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [CorePagesSettingController::class, 'edit'])->name('edit');
    });

    //testimonial area
    Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'],function (){
        Route::get('testimonial', [TestimonialController::class, 'index'])->name('index');
        Route::post('store', [TestimonialController::class, 'store'])->name('store');
        Route::get('info/{id}', [TestimonialController::class, 'info'])->name('info');
        Route::post('update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::post('delete/{id}', [TestimonialController::class, 'delete'])->name('delete');
    });

    // faq
    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
        Route::get('faq', [FaqController::class, 'index'])->name('index');
        Route::post('faq-store', [FaqController::class, 'store'])->name('store');
        Route::post('faq-delete/{id}', [FaqController::class, 'delete'])->name('delete');
        Route::get('faq-edit/{id}', [FaqController::class, 'edit'])->name('edit');
    });

    Route::get('privacy-policy', [SuperAdminSettingController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('cookie-policy', [SuperAdminSettingController::class, 'cookiePolicy'])->name('cookie-policy');
    Route::get('terms-condition', [SuperAdminSettingController::class, 'termsCondition'])->name('terms-condition');
    Route::get('refund-policy', [SuperAdminSettingController::class, 'refundPolicy'])->name('refund-policy');
});

//custom domain
Route::group(['prefix' => 'custom-domain', 'as' => 'custom_domain.'], function () {
    Route::get('/', [CustomDomainRequestController::class, 'index'])->name('index');
    Route::get('info/{id}', [CustomDomainRequestController::class, 'info'])->name('info');
    Route::POST('update/{id}', [CustomDomainRequestController::class, 'update'])->name('update');
});

Route::get('/contact-us-list', [ContactUsController::class, 'contactList'])->name('contact-list');

Route::group(['prefix' => 'notification', 'as' => 'notification.'], function () {
    Route::get('notification-mark-all-as-read', [NotificationController::class, 'notificationMarkAllAsRead'])->name('notification-mark-all-as-read');
    Route::get('notification-mark-as-read/{id}', [NotificationController::class, 'notificationMarkAsRead'])->name('notification-mark-as-read');
});
