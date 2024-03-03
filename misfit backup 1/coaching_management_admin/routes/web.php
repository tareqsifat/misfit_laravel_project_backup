<?php

use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\ShowPosts;
use App\Models\Asset\AssetCategory;
use App\Models\User;
use Carbon\Carbon;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => '', 'namespace' => "Livewire"], function () {
    Route::get('/', "Home")->name('homepage');
    Route::get('/contact', "Contact")->name('contact_page');
    Route::get('/notice', "Notice")->name('notice_page');
    Route::get('/notice-details/{id}', "NoticeDetails")->name('notice_details_page');
    Route::get('/news-events', "NewsEvents")->name('news_event_page');
    Route::get('/news-event-details/{id}', "NewsEventDetails")->name('news_event_details_page');
    Route::get('/teacher', "Teacher")->name('teacher_page');
    Route::get('/login', "Login");
    Route::get('/register', "Register");
});

Route::group( ['prefix'=>'','namespace' => "Controllers" ],function(){
    Route::get('/website','WebsiteController@website');
});

Route::get('/admin', function () {
    return view('backend.dashboard');
})->name('admin');


Route::get('/dump_data_test',function () {
    // $user = User::where('id', 2)->with('branch_admin')->first();
    $user = Carbon::now()->month;
    dd($user);
});

Route::get('/my_ip',function () {
    $clientIP = request()->ip();
    $clientIP2 = \Request::getClientIp(true);
    dd($clientIP, $clientIP2);
});

Route::get('/data-reload', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true]);
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations', '--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('passport:install');
    return redirect()->back();
});


