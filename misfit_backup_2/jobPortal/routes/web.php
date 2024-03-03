<?php

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Company\JobPostController as CompanyJobPostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JobSeeker\AddressController;
use App\Http\Controllers\JobSeeker\EducationController;
use App\Http\Controllers\JobSeeker\ExperienceController;
use App\Http\Controllers\JobSeeker\SkillController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\WebPageController;
use Illuminate\Support\Facades\Auth;
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


//Auth Routes
 Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
//     Route::post('otp_verification', [AuthController::class, 'otp_verification'])->name('otp_verification');
//     Route::get('send_auth_email', [AuthController::class, 'send_auth_email'])->name('send_auth_email');
     Route::post('logout', [AuthController::class, 'logout'])->name('auth_logout');
 });


// Admin Routes
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
    Route::resource('company', CompanyController::class);
    Route::resource('job-posts', JobPostController::class);
});

Route::group([
    'prefix' => 'company',
    'middleware' => 'company',
    'name' => 'company.'
], function() {
    Route::get('company-dashboard', [CompanyDashboardController::class, 'dashboard'])->name('company_dashboard');
    Route::resource('blog', BlogController::class)->names([
        'index'   => 'company.blog.index',
        'create'  => 'company.blog.create',
        'store'   => 'company.blog.store',
        'show'    => 'company.blog.show',
        'edit'    => 'company.blog.edit',
        'update'  => 'company.blog.update',
        'destroy' => 'company.blog.destroy',
    ]);
    Route::resource('job-posts', CompanyJobPostController::class)->names([
        'index'   => 'company.job_post.index',
        'create'  => 'company.job_post.create',
        'store'   => 'company.job_post.store',
        'show'    => 'company.job_post.show',
        'edit'    => 'company.job_post.edit',
        'update'  => 'company.job_post.update',
        'destroy' => 'company.job_post.destroy',
    ]);
});


Route::controller(WebPageController::class)->name('web.')->group(function(){
    Route::post('send-contact-email', 'sendContactEmail')->name('send-contact-email');
    Route::get('/','home')->name('home');
    Route::get('blog', 'blogs')->name('blog');
    Route::get('blog-details/{id}', 'blog_details')->name('blog_details');
    Route::get('company', 'company')->name('company');
    Route::get('company_details/{id}', 'company_details')->name('company_details');
    Route::get('contact', 'contact')->name('contact');
    Route::get('job_post_list', 'jobs')->name('job_post_list');
    Route::get('job_details/{id}', 'job_details')->name('job_details');
});


Auth::routes();

Route::post('/company-login',[LoginController::class,'companyLogin'])->name('company.login');
Route::get('/auth_user', [AuthController::class, 'auth_user'])->name('auth_user');
Route::get('auth/admin/admin_login', [LoginController::class,'showAdminLoginForm']);
Route::post('auth/admin/admin_login', [LoginController::class,'adminLogin'])->name('admin_login');
Route::group([
    'middleware' => 'auth',
    'prefix' => 'job_seeker'
], function (){
    Route::resource('address', AddressController::class);
    Route::resource('skill', SkillController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('education', EducationController::class);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
