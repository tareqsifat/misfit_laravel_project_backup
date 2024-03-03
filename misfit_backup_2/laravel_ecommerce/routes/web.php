<?php

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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
// Route::get('/about', [WebsiteController::class, 'about']);


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/','webController@index')->name('website_index');
Route::get('/products','webController@products')->name('website_products');
Route::get('/details','webController@details')->name('website_details');
Route::get('/cart','webController@cart')->name('website_cart');
Route::get('/checkout','webController@checkout')->name('website_checkout');
Route::get('/wishlist','webController@wishlist')->name('website_wishlist');
Route::get('/contact','webController@contact')->name('website_contact');


Route::group( [
    'prefix'=>'admin',
    'middleware'=>['auth'],
    'namespace'=>'Admin'
],function(){

    Route::get('/','AdminController@index')->name('admin_index');
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::post('/login','Auth\LoginController@login')->middleware('check_user_is_active');

Route::get('/admin','Admin\AdminController@index')->name('admin_detail');

Route::get('/admin','AdminController@index')->name('admin_index') ->middleware('auth');



// User management
Route::group( [
    'prefix'=>'user',
    'middleware'=>['auth', 'check_user_is_active' ,'super_admin'],
    // 'middleware'=>['auth'],
    'namespace' => 'Admin' 

],

    function(){ 

        Route::get('/index','UserController@index')->name('admin_user_index');
        Route::get('/view/{id}','UserController@view')->name('admin_user_view');
        Route::get('/create','UserController@create')->name('admin_user_create');
        Route::post('/store','UserController@store')->name('admin_user_store');
        Route::get('/edit/{id}','UserController@edit')->name('admin_user_edit');
        Route::post('/update','UserController@update')->name('admin_user_update');
        Route::post('/delete','UserController@delete')->name('admin_user_delete');
        Route::get('/test/{id}','UserController@test')->name('admin_user_test');
        
});
 
// User_role management
Route::group( [
    'prefix'=>'user_role',
    'middleware'=>['auth'],
    'namespace' => 'Admin' 

],

function(){ 

    Route::get('/index','UserRoleController@index')->name('admin_user_role_index');
    Route::get('/view/{id}','UserRoleController@view')->name('admin_user_role_view');
    Route::get('/create','UserRoleController@create')->name('admin_user_role_create');
    Route::post('/store','UserRoleController@store')->name('admin_user_role_store');
    Route::get('/edit','UserRoleController@edit')->name('admin_user_role_edit');
    Route::post('/update','UserRoleController@update')->name('admin_user_role_update');
    Route::post('/delete','UserRoleController@delete')->name('admin_user_role_delete');
    
});
 


Route::group( [
    'prefix'=>'admin',
    'middleware'=>['auth'],
    'namespace' => 'Admin' 

], function(){

    Route::get('/','AdminController@index')->name('admin_index');

    // basic page  
    Route::get('/blade-index','AdminController@blade_index')->name('admin_blade-index');
    Route::get('/blade-create','AdminController@blade_create')->name('admin_blade_create');
    Route::get('/blade-view','AdminController@blade_view')->name('admin_blade_view');

});


Route::group([
    'prefix'=>'admin/product',
    'middleware'=>['auth'],
    'namespace' => 'Product' 

], function(){ 


    Route::resource('brand', 'BrandController');
    Route::resource('main_category', 'MainCategoryController');
    Route::resource('category', 'CategoryController');
    Route::resource('sub_Category', 'SubCategoryController');
    Route::resource('color', 'ColorController');
    Route::resource('size', 'SizeController');
    Route::resource('unit', 'UnitController');
    Route::resource('status', 'StatusController');
    Route::resource('product', 'ProductController');
    Route::resource('publication', 'PublicationController');
    Route::resource('writer', 'WriterController');
    Route::resource('vendor', 'vendorController');
    
    Route::get('/get-all-category-selected-by-main-category/{main_category_id}','CategoryController@get_all_category_by_main_category')
    ->name('get_all_category_selected_by_main_category');
    Route::get('/get-all-main-category-json','MainCategoryController@get_main_category_json')->name('get_main_category_json');
    Route::get('/get-all-category-json','CategoryController@get_category_json')->name('get_category_json');
});

Route::group([
        'prefix' => 'file-manager',
        'Middleware' => ['auth'],
        'namespace' => 'Admin'
    ],function(){
        Route::post('/store-file', 'FileManagerController@store_file')->name('admin_fm_store_file');
        Route::get('/get-files','FileManagerController@get_files')->name('admin_fm_get_files');
        Route::delete('/delete-file/{image}','FileManagerController@delete_file')->name('admin_fm_delete_file');
    });

    Route::post('/testing','TestController@index')->name('test_route');  
 