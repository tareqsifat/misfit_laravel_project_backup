<?php

use App\Http\Controllers\addon\saas\frontend\ContactUsController;
use App\Http\Controllers\addon\saas\frontend\FrontendController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Alumni\GoogleAuthController;
use App\Http\Controllers\SuperAdmin\VersionUpdateController;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/local/{ln}', function ($ln) {
    $language = Language::where('iso_code', $ln)->first();
    if (!$language) {
        $language = Language::where('default', 1)->first();
        if ($language) {
            $ln = $language->iso_code;
        }
    }
    session()->put('local', $ln);
    return redirect()->back();
})->name('local');


Auth::routes(['verify' => false]);

Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('/contact-us', [FrontendController::class, 'contactUs'])->name('contact-us');

Route::get('password/reset/verify/{token}/{email}', [ForgotPasswordController::class, 'forgetVerifyForm'])->name('password.reset.verify_form');
Route::get('password/reset/verify/{token}', [ForgotPasswordController::class, 'forgetVerify'])->name('password.reset.verify');
Route::post('password/reset/verify-resend/{token}', [ForgotPasswordController::class, 'forgetVerifyResend'])->name('password.reset.verify_resend');
Route::post('password/reset/update/{token}', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('google2fa/authenticate/verify', [GoogleAuthController::class, 'verifyView'])->name('google2fa.authenticate.verify');
    Route::post('google2fa/authenticate/verify/action', [GoogleAuthController::class, 'verify'])->name('google2fa.authenticate.verify.action');
    Route::post('google2fa/authenticate/enable', [GoogleAuthController::class, 'enable'])->name('google2fa.authenticate.enable');
    Route::post('google2fa/authenticate/disable', [GoogleAuthController::class, 'disable'])->name('google2fa.authenticate.disable');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook-login');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
// pages
Route::get('page/{slug}', [FrontendController::class, 'page'])->name('pages');

Route::post('contact-us-store', [ContactUsController::class, 'store'])->name('contact_us.store');

Route::get('version-update', [VersionUpdateController::class, 'versionUpdate'])->name('version-update')->withoutMiddleware(['version.update']);
Route::post('process-update', [VersionUpdateController::class, 'processUpdate'])->name('process-update')->withoutMiddleware(['version.update']);
