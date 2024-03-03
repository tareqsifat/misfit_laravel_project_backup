<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\WebPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('show-login-form');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('otp_verification', [AuthController::class, 'otp_verification'])->name('otp_verification');
    Route::get('send_auth_email', [AuthController::class, 'send_auth_email'])->name('send_auth_email');
});

Route::group([
        'prefix' => 'admin',
        'middleware' => 'admin'
], function(){
    //DashBoard Routes
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard_show');
    Route::get('advanced_form', [DashboardController::class, 'advanced_form'])->name('advanced_form');
    Route::get('editor_form', [DashboardController::class, 'editor_form'])->name('editor_form');
    Route::get('general_form', [DashboardController::class, 'general_form'])->name('general_form');
    Route::get('validation_form', [DashboardController::class, 'validation_form'])->name('validation_form');
    Route::get('data_table', [DashboardController::class, 'data_table'])->name('data_table');
    Route::get('jsgrid_table', [DashboardController::class, 'grid_table'])->name('jsgrid_table');
    Route::get('simple_table', [DashboardController::class, 'simple_table'])->name('simple_table');

    //Admin blog Resource
    Route::resource('blog', BlogController::class);
});


Route::controller(WebPageController::class)->name('web.')->group(function(){
    Route::post('send-contact-email', [WebPageController::class, 'sendContactEmail'])->name('send-contact-email');
    Route::get('/','home')->name('home');
    Route::get('blog', [WebPageController::class, 'blogs'])->name('blog');
    Route::get('company', [WebPageController::class, 'company'])->name('company');
    Route::get('contact', [WebPageController::class, 'contact'])->name('contact');
});
