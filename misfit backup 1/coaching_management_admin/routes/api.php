<?php

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

Route::group(
    ['prefix' => 'v1', 'namespace' => 'Controllers'],
    function () {

        Route::group(['prefix' => '/user', 'middleware' => ['guest:api']], function () {
            Route::post('/get-token', 'Auth\ApiLoginController@get_token');
            Route::post('/api-login', 'Auth\ApiLoginController@login');
            Route::post('/api-register', 'Auth\ApiLoginController@register');
            Route::get('/auth-check', 'Auth\ApiLoginController@auth_check');
            Route::post('/forget-mail', 'Auth\ApiLoginController@forget_mail');
            Route::post('/check-code', 'Auth\ApiLoginController@check_code');
            Route::post('/logout-from-all-devices', 'Auth\ApiLoginController@logout_from_all_devices');
        });

        Route::group(['middleware' => ['auth:api']], function () {

            // guest user api
            Route::group(['prefix' => 'user'], function () {
                Route::post('/api-logout', 'Auth\ApiLoginController@logout');
                Route::post('/user_info', 'Auth\ApiLoginController@user_info');
                Route::post('/check-auth', 'Auth\ApiLoginController@check_auth');
                Route::post('/user_update', 'Auth\ApiLoginController@user_update');
                Route::post('/update_password', 'Auth\ApiLoginController@update_password');
                Route::post('/find-user-info', 'Auth\ApiLoginController@find_user_info');
            });

            //authorized user api
            Route::group(['prefix' => 'user'], function () {
                Route::post('/update-profile', 'Auth\ProfileController@update_profile');
                Route::get('/all','Auth\UserController@all');
                Route::post('/store','Auth\UserController@store');
                Route::post('/branch_wise_users','Auth\UserController@branch_wise_users');
                Route::post('/canvas-store','Auth\UserController@canvas_store');
                Route::post('/update','Auth\UserController@update');
                Route::post('/soft-delete','Auth\UserController@soft_delete');
                Route::post('/destroy','Auth\UserController@destroy');
                Route::post('/restore','Auth\UserController@restore');
                Route::post('/bulk-import','Auth\UserController@bulk_import');
                Route::get('/{id}','Auth\UserController@show');
            });

            // user role
            Route::group(['prefix' => 'user-role'], function () {
                Route::get('/all','Auth\UserRoleController@all');
                Route::post('/store','Auth\UserRoleController@store');
                Route::post('/canvas-store','Auth\UserRoleController@canvas_store');
                Route::post('/update','Auth\UserRoleController@update');
                Route::post('/canvas-update','Auth\UserRoleController@canvas_update');
                Route::post('/soft-delete','Auth\UserRoleController@soft_delete');
                Route::post('/destroy','Auth\UserRoleController@destroy');
                Route::post('/restore','Auth\UserRoleController@restore');
                Route::post('/bulk-import','Auth\UserRoleController@bulk_import');
                Route::get('/{id}','Auth\UserRoleController@show');
            });

            // contact message apis
            Route::group(['prefix' => 'contact-message'], function () {
                Route::get('/all','Admin\ContactMessageController@all');
                Route::post('/store','Admin\ContactMessageController@store');
                Route::post('/canvas-store','Admin\ContactMessageController@canvas_store');
                Route::post('/update','Admin\ContactMessageController@update');
                Route::post('/canvas-update','Admin\ContactMessageController@canvas_update');
                Route::post('/soft-delete','Admin\ContactMessageController@soft_delete');
                Route::post('/destroy','Admin\ContactMessageController@destroy');
                Route::post('/restore','Admin\ContactMessageController@restore');
                Route::post('/bulk-import','Admin\ContactMessageController@bulk_import');
                Route::get('/{id}','Admin\ContactMessageController@show');
            });

            // settings apis
            Route::group(['prefix' => 'settings'], function () {
                Route::get('/all','Management\SettingsController@all');
                Route::get('/all_site_settings','Management\SettingsController@all_settings');
                Route::get('/get_site_logo','Management\SettingsController@site_logo');
                Route::post('/update_logo','Management\SettingsController@updateLogo');
                Route::post('/store','Management\SettingsController@store');
                Route::post('/canvas-store','Management\SettingsController@canvas_store');
                Route::post('/update','Management\SettingsController@update');
                Route::post('/canvas-update','Management\SettingsController@canvas_update');
                Route::post('/destroy','Management\SettingsController@destroy');
                Route::post('/bulk-import','Management\SettingsController@bulk_import');
                Route::get('/{id}','Management\SettingsController@show');
            });


            // news and events apis
            Route::group(['prefix' => 'news'], function () {
                Route::get('/all','NewsEventController@all');
                Route::get('/all_site_settings','NewsEventController@all_settings');
                Route::post('/store','NewsEventController@store');
                Route::post('/canvas-store','NewsEventController@canvas_store');
                Route::post('/update','NewsEventController@update');
                Route::post('/canvas-update','NewsEventController@canvas_update');
                Route::post('/destroy','NewsEventController@destroy');
                Route::post('/bulk-import','NewsEventController@bulk_import');
                Route::get('/{id}','NewsEventController@show');
            });

            // notice apis
            Route::group(['prefix' => 'notice'], function () {
                Route::get('/all','NoticeController@all');
                Route::post('/store','NoticeController@store');
                Route::post('/canvas-store','NoticeController@canvas_store');
                Route::post('/update','NoticeController@update');
                Route::post('/canvas-update','NoticeController@canvas_update');
                Route::post('/destroy','NoticeController@destroy');
                Route::post('/bulk-import','NoticeController@bulk_import');
                Route::get('/{id}','NoticeController@show');
            });

            Route::group(['prefix' => 'banner'], function () {
                Route::get('/all','BannerController@all');
                Route::post('/store','BannerController@store');
                Route::post('/canvas-store','BannerController@canvas_store');
                Route::post('/update','BannerController@update');
                Route::post('/canvas-update','BannerController@canvas_update');
                Route::post('/destroy','BannerController@destroy');
                Route::post('/bulk-import','BannerController@bulk_import');
                Route::get('/{id}','BannerController@show');
            });


            // subscriber api
            Route::group(['prefix' => 'subscriber'], function () {
                Route::get('/all','Management\SubscriberController@all');
                Route::post('/store','Management\SubscriberController@store');
                Route::post('/send_mail','Management\SubscriberController@send_mail');
                Route::post('/canvas-store','Management\SubscriberController@canvas_store');
                Route::post('/update','Management\SubscriberController@update');
                Route::post('/canvas-update','Management\SubscriberController@canvas_update');
                Route::post('/soft-delete','Management\SubscriberController@soft_delete');
                Route::post('/destroy','Management\SubscriberController@destroy');
                Route::post('/restore','Management\SubscriberController@restore');
                Route::post('/bulk-import','Management\SubscriberController@bulk_import');
                Route::get('/{id}','Management\SubscriberController@show');
            });
            

            // Branch api
            Route::group(['prefix' => 'branch'], function () {
                Route::get('/all','Management\BranchController@all');
                Route::get('/branch-batches/{id}','Management\BranchController@branch_batches');
                Route::post('/store','Management\BranchController@store');
                Route::post('/create-branch-admin','Management\BranchController@create_branch_admin');
                Route::post('/canvas-store','Management\BranchController@canvas_store');
                Route::post('/update','Management\BranchController@update');
                Route::post('/canvas-update','Management\BranchController@canvas_update');
                Route::post('/soft-delete','Management\BranchController@soft_delete');
                Route::post('/destroy','Management\BranchController@destroy');
                Route::post('/restore','Management\BranchController@restore');
                Route::post('/bulk-import','Management\BranchController@bulk_import');
                Route::get('/{id}','Management\BranchController@show');
            });

            // Branch assets api
            Route::group(['prefix' => 'branch/assets'], function () {
                Route::get('/all','Management\BranchAssetController@all');
                Route::get('/get_all_branches','Management\BranchAssetController@get_all_branches');
                Route::post('/store','Management\BranchAssetController@store');
                Route::post('/canvas-store','Management\BranchAssetController@canvas_store');
                Route::post('/update','Management\BranchAssetController@update');
                Route::post('/canvas-update','Management\BranchAssetController@canvas_update');
                Route::post('/soft-delete','Management\BranchAssetController@soft_delete');
                Route::post('/destroy','Management\BranchAssetController@destroy');
                Route::post('/restore','Management\BranchAssetController@restore');
                Route::post('/bulk-import','Management\BranchAssetController@bulk_import');
                Route::get('/{id}','Management\BranchAssetController@show');
            });


            // Branch assets api
            Route::group(['prefix' => 'branch/assets_shop'], function () {
                Route::get('/all','Management\AssetShopController@all');
                Route::post('/store','Management\AssetShopController@store');
                Route::post('/canvas-store','Management\AssetShopController@canvas_store');
                Route::post('/update','Management\AssetShopController@update');
                Route::post('/canvas-update','Management\AssetShopController@canvas_update');
                Route::post('/destroy','Management\AssetShopController@destroy');
                Route::post('/bulk-import','Management\AssetShopController@bulk_import');
                Route::get('/{id}','Management\AssetShopController@show');
            });


            // Branch assets category api
            Route::group(['prefix' => 'branch/asset-category'], function () {
                Route::get('/all','Management\BranchAssetCategoryController@all');
                Route::post('/store','Management\BranchAssetCategoryController@store');
                Route::post('/canvas-store','Management\BranchAssetCategoryController@canvas_store');
                Route::post('/update','Management\BranchAssetCategoryController@update');
                Route::post('/canvas-update','Management\BranchAssetCategoryController@canvas_update');
                Route::post('/soft-delete','Management\BranchAssetCategoryController@soft_delete');
                Route::post('/destroy','Management\BranchAssetCategoryController@destroy');
                Route::post('/restore','Management\BranchAssetCategoryController@restore');
                Route::post('/bulk-import','Management\BranchAssetCategoryController@bulk_import');
                Route::get('/{id}','Management\BranchAssetCategoryController@show');
            });

            // Product apis
            Route::group(['prefix' => 'product'], function () {
                Route::get('/all','Management\Product\ProductController@all');
                Route::post('/store','Management\Product\ProductController@store');
                Route::post('/stock-update','Management\Product\ProductController@update_stock');
                Route::post('/canvas-store','Management\Product\ProductController@canvas_store');
                Route::post('/update','Management\Product\ProductController@update');
                Route::post('/canvas-update','Management\Product\ProductController@canvas_update');
                Route::post('/soft-delete','Management\Product\ProductController@soft_delete');
                Route::post('/destroy','Management\Product\ProductController@destroy');
                Route::post('/restore','Management\Product\ProductController@restore');
                Route::post('/bulk-import','Management\Product\ProductController@bulk_import');
                Route::get('/{id}','Management\Product\ProductController@show');
            });

            // admin sections
            Route::get('/dashboard_stats','Admin\DashboardController@get_dashboard_stats');
            Route::get('/dashboard_stats_by_month/{month}','Admin\DashboardController@get_dashboard_stats_by_month');
            Route::get('/branch_dashboard_stats','Admin\DashboardController@get_dashboard_stats');
            Route::get('/branch_dashboard_stats_by_month/{month}','Admin\DashboardController@branch_dashboard_stats_by_month');
            Route::get('/student_dashboard_stats','Admin\DashboardController@student_dashboard_stats');
            Route::get('/teacher_dashboard_stats','Admin\DashboardController@teacher_dashboard_stats');

            Route::group(['prefix' => 'account/admin-income'], function () {
                Route::get('/all','Management\Branch\IncomeController@admin_incomes');
                Route::get('/{id}','Management\Branch\IncomeController@admin_show');
            });

            Route::group(['prefix' => 'account/admin-expense'], function () {
                Route::get('/all','Management\Branch\ExpenseController@admin_expense');
                Route::get('/{id}','Management\Branch\ExpenseController@admin_details');
            });

            Route::group(['prefix' => 'account/admin-accounts'], function () {
                Route::get('/all','Management\Branch\AccountsController@admin_accounts');
            });

            Route::group(['prefix' => 'account/admin_monthly_fee'], function () {
                Route::get('/all','Management\Branch\MonthlyfeeController@admin_monthly_fees');
                Route::get('/{id}','Management\Branch\MonthlyfeeController@admin_details');
            });

            // admin class api
            Route::group(['prefix' => 'institute/admin-class'], function () {
                Route::get('/all','Management\Institute\InstituteClassController@admin_classes');
                Route::get('/{id}','Management\Institute\InstituteClassController@admin_show');
            });

            Route::group(['prefix' => 'institute/admin-subjects'], function () {
                Route::get('/all','Management\Institute\InstituteClassSubjectController@admin_subjects');
                Route::get('/{id}','Management\Institute\InstituteClassSubjectController@admin_show');
            });

            Route::group(['prefix' => 'institute/admin-batch'], function () {
                Route::get('/all','Management\Institute\InstituteClassBatchController@admin_batchs');
                Route::get('/{id}','Management\Institute\InstituteClassBatchController@admin_show');
            });

            Route::group(['prefix' => 'institute/admin-exam'], function () {
                Route::get('/all','Management\Institute\InstituteBatchExamController@admin_exams');
                Route::get('/{id}','Management\Institute\InstituteBatchExamController@admin_show');
            });

            Route::group(['prefix' => 'institute/admin-class-batch-time'], function () {
                Route::get('/all','Management\Institute\InstituteClassBatchTimeScheduleController@admin_schedules');
                Route::get('/{id}','Management\Institute\InstituteClassBatchTimeScheduleController@admin_show');
            });

            Route::group(['prefix' => 'admin-employee'], function () {
                Route::get('/all','Management\Institute\EmployeeController@admin_employee');
                Route::get('/{id}','Management\Institute\EmployeeController@admin_show');
            });

            Route::group(['prefix' => 'institute/admin-teacher'], function () {
                Route::get('/all','Management\Institute\InstituteTeacherController@admin_teachers');
                Route::get('/{id}','Management\Institute\InstituteTeacherController@admin_show');
            });

            Route::group(['prefix' => 'institute/admin-student'], function () {
                Route::get('/all','Management\Institute\InstituteStudentController@admin_students');
                Route::get('/{id}','Management\Institute\InstituteStudentController@admin_show');
            });

            Route::group(['prefix' => 'admin-salary-statement'], function () {
                Route::get('/all','Management\SalaryStatementController@admin_salary');
                Route::get('/{id}','Management\SalaryStatementController@admin_show');
            });

            Route::group(['prefix' => 'admin-customer'], function () {
                Route::get('/all','Management\CRM\CustomerController@admin_customer');
                Route::get('/{id}','Management\CRM\CustomerController@admin_show');
            });

            Route::group(['prefix' => 'admin_attendence_student'], function () {
                Route::get('/all','Management\AttendenceController@admin_student_attendence');
                Route::get('/{id}','Management\AttendenceController@admin_show');
            });

            Route::group(['prefix' => 'admin_attendence_employee'], function () {
                Route::get('/all','Management\AttendenceController@admin_employee_attendence');
                Route::get('/{id}','Management\AttendenceController@admin_show');
            });

            // Product order apis
            Route::group(['prefix' => 'product/order'], function () {
                Route::get('/all','Management\Product\ProductOrderController@all');
                Route::get('/all_order','Management\Product\ProductOrderController@branch_order_all');
                Route::post('/store','Management\Product\ProductOrderController@store');
                Route::post('/update-order','Management\Product\ProductOrderController@update_order');
                Route::post('/status_update','Management\Product\ProductOrderController@update_status');
                Route::post('/payment_status_update','Management\Product\ProductOrderController@payment_status_update');
                Route::get('/order_payments/{id}','Management\Product\ProductOrderController@get_order_payment');
                Route::post('/bulk-import','Management\Product\ProductOrderController@bulk_import');
                Route::get('/{id}','Management\Product\ProductOrderController@show');
            });

            // Product stock apis
            Route::group(['prefix' => 'product/stock'], function () {
                Route::get('/all','Management\Product\ProductOrderController@all');
                Route::post('/store','Management\Product\ProductOrderController@store');
                Route::post('/update','Management\Product\ProductOrderController@update');
                Route::post('/bulk-import','Management\Product\ProductOrderController@bulk_import');
                Route::get('/{id}','Management\Product\ProductOrderController@show');
            });

            // branch account apis
            Route::group(['prefix' => 'institute/branch-accounts'], function () {
                Route::get('/all','Management\Branch\AccountsController@all');
                Route::get('/all_accounts', 'Management\Branch\AccountsController@all_accounts');
                Route::post('/store','Management\Branch\AccountsController@store');
                Route::post('/transfer-balance','Management\Branch\AccountsController@transfer_balance');
                Route::post('/canvas-store','Management\Branch\AccountsController@canvas_store');
                Route::post('/update','Management\Branch\AccountsController@update');
                Route::post('/canvas-update','Management\Branch\AccountsController@canvas_update');
                Route::post('/soft-delete','Management\Branch\AccountsController@soft_delete');
                Route::post('/destroy','Management\Branch\AccountsController@destroy');
                Route::post('/restore','Management\Branch\AccountsController@restore');
                Route::post('/bulk-import','Management\Branch\AccountsController@bulk_import');
                Route::get('/{id}','Management\Branch\AccountsController@show');
            });

            // expense apis
            Route::group(['prefix' => 'account/expense'], function () {
                Route::get('/all','Management\Branch\ExpenseController@all');
                Route::post('/store','Management\Branch\ExpenseController@store');
                Route::post('/canvas-store','Management\Branch\ExpenseController@canvas_store');
                Route::post('/update','Management\Branch\ExpenseController@update');
                Route::post('/canvas-update','Management\Branch\ExpenseController@canvas_update');
                Route::post('/soft-delete','Management\Branch\ExpenseController@soft_delete');
                Route::post('/destroy','Management\Branch\ExpenseController@destroy');
                Route::post('/restore','Management\Branch\ExpenseController@restore');
                Route::post('/bulk-import','Management\Branch\ExpenseController@bulk_import');
                Route::get('/{id}','Management\Branch\ExpenseController@show');
            });

            // income apis
            Route::group(['prefix' => 'account/income'], function () {
                Route::get('/all','Management\Branch\IncomeController@all');
                Route::post('/store','Management\Branch\IncomeController@store');
                Route::post('/canvas-store','Management\Branch\IncomeController@canvas_store');
                Route::post('/update','Management\Branch\IncomeController@update');
                Route::post('/canvas-update','Management\Branch\IncomeController@canvas_update');
                Route::post('/soft-delete','Management\Branch\IncomeController@soft_delete');
                Route::post('/destroy','Management\Branch\IncomeController@destroy');
                Route::post('/restore','Management\Branch\IncomeController@restore');
                Route::post('/bulk-import','Management\Branch\IncomeController@bulk_import');
                Route::get('/{id}','Management\Branch\IncomeController@show');
            });

            // income apis
            Route::group(['prefix' => 'account/monthly_fee'], function () {
                Route::get('/all','Management\Branch\MonthlyfeeController@all');
                Route::get('/get_all_students','Management\Branch\MonthlyfeeController@get_all_students');
                Route::get('/single_student_monthly_fees','Management\Branch\MonthlyfeeController@single_student_monthly_fees');
                Route::post('/store','Management\Branch\MonthlyfeeController@store');
                Route::post('/canvas-store','Management\Branch\MonthlyfeeController@canvas_store');
                Route::post('/update','Management\Branch\MonthlyfeeController@update');
                Route::post('/canvas-update','Management\Branch\MonthlyfeeController@canvas_update');
                Route::post('/soft-delete','Management\Branch\MonthlyfeeController@soft_delete');
                Route::post('/destroy','Management\Branch\MonthlyfeeController@destroy');
                Route::post('/restore','Management\Branch\MonthlyfeeController@restore');
                Route::post('/bulk-import','Management\Branch\MonthlyfeeController@bulk_import');
                Route::get('/{id}','Management\Branch\MonthlyfeeController@show');
            });

            // branch account category apis
            Route::group(['prefix' => 'institute/branch-account/category'], function () {
                Route::get('/all','Management\Branch\AccountCategoryController@all');
                Route::get('/get_all_categories','Management\Branch\AccountCategoryController@get_all_categories');
                Route::post('/store','Management\Branch\AccountCategoryController@store');
                Route::post('/visibility_update','Management\Branch\AccountCategoryController@visibility_update');
                Route::post('/canvas-store','Management\Branch\AccountCategoryController@canvas_store');
                Route::post('/update','Management\Branch\AccountCategoryController@update');
                Route::post('/canvas-update','Management\Branch\AccountCategoryController@canvas_update');
                Route::post('/destroy','Management\Branch\AccountCategoryController@destroy');
                Route::post('/bulk-import','Management\Branch\AccountCategoryController@bulk_import');
                Route::get('/{id}','Management\Branch\AccountCategoryController@show');
            });

            // branch account category apis

            Route::group(['prefix' => 'notification'], function () {
                Route::get('/all','Management\NotificationController@all');
                Route::get('/update_user_notification_status','Management\NotificationController@user_notification_update');
                Route::post('/batch_notification','Management\NotificationController@batch_notification');
                Route::post('/update_notification_unread','Management\NotificationController@update_notification_unread');
                Route::get('all_users', 'Management\NotificationController@all_users');
                Route::post('/store','Management\NotificationController@store');
                Route::post('/update','Management\NotificationController@update');
                Route::post('/destroy','Management\NotificationController@destroy');
                Route::get('/{id}','Management\NotificationController@show');
                // Route::post('/bulk-import','Management\Branch\AccountCategoryController@bulk_import');
            });

            Route::group(['prefix' => 'salary-statement'], function () {
                Route::get('/all','Management\SalaryStatementController@all');
                Route::get('/get_all_employees', 'Management\SalaryStatementController@get_all_employees');
                Route::get('/get_all_employees_by_month/{month}', 'Management\SalaryStatementController@get_all_employees_by_month');
                Route::get('/teacher_salary_statements', 'Management\SalaryStatementController@teacher_salary_statements');
                Route::post('/submit-employee-salary','Management\SalaryStatementController@submit_employee_salary');
                Route::post('/store','Management\SalaryStatementController@store');
                Route::post('/update','Management\SalaryStatementController@update');
                Route::post('/destroy','Management\SalaryStatementController@destroy');
                Route::get('/{id}','Management\SalaryStatementController@show');
                // Route::post('/bulk-import','Management\Branch\AccountCategoryController@bulk_import');
            });

            // user attendence routes
            Route::group(['prefix' => 'attendence'], function () {
                Route::get('/all','Management\AttendenceController@all');
                Route::post('/store','Management\AttendenceController@store');
                Route::post('/update','Management\AttendenceController@update');
                Route::post('/destroy','Management\AttendenceController@destroy');
                Route::get('/{id}','Management\AttendenceController@show');
            });

            // user review route
            Route::group(['prefix' => 'user_review'], function () {
                Route::get('/all','Management\ReviewController@all');
                Route::post('/store','Management\ReviewController@store');
                Route::post('/update','Management\ReviewController@update');
                Route::post('/destroy','Management\ReviewController@destroy');
                Route::get('/{id}','Management\ReviewController@show');
            });

            // Customer api routes
            Route::group(['prefix' => 'customer'], function () {
                Route::get('/all','Management\CRM\CustomerController@all');
                Route::post('/store','Management\CRM\CustomerController@store');
                Route::post('/update','Management\CRM\CustomerController@update');
                Route::post('/destroy','Management\CRM\CustomerController@destroy');
                Route::get('/{id}','Management\CRM\CustomerController@show');
            });

            // leave application api routes
            Route::group(['prefix' => 'leave-application'], function () {
                Route::get('/all','Management\LeaveApplicationController@all');
                Route::post('/store','Management\LeaveApplicationController@store');
                Route::post('/update','Management\LeaveApplicationController@update');
                Route::post('/destroy','Management\LeaveApplicationController@destroy');
                Route::get('/{id}','Management\LeaveApplicationController@show');
            });

            // breaking news api routes
            Route::group(['prefix' => 'breaking_news'], function () {
                Route::get('/all','Management\BreakingNewsController@all');
                Route::post('/store','Management\BreakingNewsController@store');
                Route::post('/update','Management\BreakingNewsController@update');
                Route::post('/destroy','Management\BreakingNewsController@destroy');
                Route::get('/{id}','Management\BreakingNewsController@show');
            });
            

            // Customer api routes
            Route::group(['prefix' => 'customer/sms_history'], function () {
                Route::get('/all','Management\CRM\CustomerSmsController@all');
                Route::post('/store','Management\CRM\CustomerSmsController@store');
                Route::post('/update','Management\CRM\CustomerSmsController@update');
                Route::post('/destroy','Management\CRM\CustomerSmsController@destroy');
                Route::get('/{id}','Management\CRM\CustomerSmsController@show');
            });

            // Customer call api routes
            Route::group(['prefix' => 'customer/call_history'], function () {
                Route::get('/all','Management\CRM\CustomerCallController@all');
                Route::post('/store','Management\CRM\CustomerCallController@store');
                Route::post('/update','Management\CRM\CustomerCallController@update');
                Route::post('/destroy','Management\CRM\CustomerCallController@destroy');
                Route::get('/{id}','Management\CRM\CustomerCallController@show');
            });


            // communication topics api routes
            Route::group(['prefix' => 'customer/communication_topic'], function () {
                Route::get('/all','Management\CRM\CommunicationTopicsController@all');
                Route::post('/store','Management\CRM\CommunicationTopicsController@store');
                Route::post('/update','Management\CRM\CommunicationTopicsController@update');
                Route::post('/destroy','Management\CRM\CommunicationTopicsController@destroy');
                Route::get('/{id}','Management\CRM\CommunicationTopicsController@show');
            });

            // institute teacher api routes
            Route::group(['prefix' => 'institute/teacher'], function () {
                Route::get('/all','Management\Institute\InstituteTeacherController@all');
                Route::get('single-teacher-attendence/{id}', 'Management\Institute\InstituteTeacherController@single_teacher_attendence_by_id');
                // Route::get('/teacher_wise_batch_time_by_id/{id}','Management\Institute\InstituteTeacherController@teacher_wise_batch_time_by_id');
                Route::post('/store','Management\Institute\InstituteTeacherController@store');
                Route::post('/update','Management\Institute\InstituteTeacherController@update');
                Route::post('/soft-delete','Management\Institute\InstituteTeacherController@soft_delete');
                Route::post('/restore','Management\Institute\InstituteTeacherController@restore');
                Route::post('/destroy','Management\Institute\InstituteTeacherController@destroy');
                Route::get('/{id}','Management\Institute\InstituteTeacherController@show');
            });


            // institute class api routes
            Route::group(['prefix' => 'institute/class'], function () {
                Route::get('/all','Management\Institute\InstituteClassController@all');
                // Route::get('/batchs/{id}')
                Route::get('/subjects/{id}','Management\Institute\InstituteClassController@subjects');
                Route::get('/batchs/{id}','Management\Institute\InstituteClassController@batchs');
                Route::post('/store','Management\Institute\InstituteClassController@store');
                Route::post('/canvas-store','Management\Institute\InstituteClassController@canvas_store');
                Route::post('/update','Management\Institute\InstituteClassController@update');
                Route::post('/canvas-update','Management\Institute\InstituteClassController@canvas_update');
                Route::post('/destroy','Management\Institute\InstituteClassController@destroy');
                Route::get('/{id}','Management\Institute\InstituteClassController@show');
            });

            // institute class subject api routes
            Route::group(['prefix' => 'institute/class_subject'], function () {
                Route::get('/all','Management\Institute\InstituteClassSubjectController@all');
                Route::post('/store','Management\Institute\InstituteClassSubjectController@store');
                Route::post('/canvas-store','Management\Institute\InstituteClassSubjectController@canvas_store');
                Route::post('/update','Management\Institute\InstituteClassSubjectController@update');
                Route::post('/canvas-update','Management\Institute\InstituteClassSubjectController@canvas_update');
                Route::post('/destroy','Management\Institute\InstituteClassSubjectController@destroy');
                Route::get('/{id}','Management\Institute\InstituteClassSubjectController@show');
            });

            // institute class batch api routes
            Route::group(['prefix' => 'institute/class_batch'], function () {
                Route::get('/all','Management\Institute\InstituteClassBatchController@all');
                Route::get('/subjects/{id}','Management\Institute\InstituteClassBatchController@batch_subjects');
                Route::post('/store','Management\Institute\InstituteClassBatchController@store');
                Route::post('/canvas-store','Management\Institute\InstituteClassBatchController@canvas_store');
                Route::post('/update','Management\Institute\InstituteClassBatchController@update');
                Route::post('/canvas-update','Management\Institute\InstituteClassBatchController@canvas_update');
                Route::post('/destroy','Management\Institute\InstituteClassBatchController@destroy');
                Route::get('/{id}','Management\Institute\InstituteClassBatchController@show');
            });


            // institute class batch time api routes
            Route::group(['prefix' => 'institute/class_batch_time'], function () {
                Route::get('/all','Management\Institute\InstituteClassBatchTimeScheduleController@all');
                Route::get('/all_routines','Management\Institute\InstituteClassBatchTimeScheduleController@all_routines');
                Route::get('/all_branches','Management\Institute\InstituteClassBatchTimeScheduleController@all_branches');
                Route::post('/branch_wise_routine','Management\Institute\InstituteClassBatchTimeScheduleController@branch_wise_routine');
                Route::post('/filter_routines_by_date','Management\Institute\InstituteClassBatchTimeScheduleController@filter_routines_by_date');
                Route::get('/student_wise_batch_time','Management\Institute\InstituteClassBatchTimeScheduleController@student_wise_batch_time');
                Route::get('/teacher_wise_batch_time','Management\Institute\InstituteClassBatchTimeScheduleController@teacher_wise_batch_time');
                Route::get('/teacher_wise_batch_time_by_id/{id}','Management\Institute\InstituteClassBatchTimeScheduleController@teacher_wise_batch_time_by_id');
                Route::post('/store','Management\Institute\InstituteClassBatchTimeScheduleController@store');
                Route::post('/update','Management\Institute\InstituteClassBatchTimeScheduleController@update');
                Route::post('/destroy','Management\Institute\InstituteClassBatchTimeScheduleController@destroy');
                Route::get('/{id}','Management\Institute\InstituteClassBatchTimeScheduleController@show');
            });

            // institute class batch api routes
            Route::group(['prefix' => 'institute/class_batch_exam'], function () {
                Route::get('/all','Management\Institute\InstituteBatchExamController@all');
                Route::get('/exam_of_teacher','Management\Institute\InstituteBatchExamController@exam_of_teacher');
                Route::post('/store','Management\Institute\InstituteBatchExamController@store');
                Route::post('/update','Management\Institute\InstituteBatchExamController@update');
                Route::post('/destroy','Management\Institute\InstituteBatchExamController@destroy');
                Route::post('/bulk-import','Management\Institute\InstituteBatchExamMarkController@bulk_import');
                Route::get('/{id}','Management\Institute\InstituteBatchExamController@show');
            });

            Route::group(['prefix' => 'institute/class_batch_exam_mark'], function () {
                Route::get('/all','Management\Institute\InstituteBatchExamMarkController@all');
                Route::get('/exam-students/{id}','Management\Institute\InstituteBatchExamMarkController@exam_students');
                Route::get('/student-exam-result','Management\Institute\InstituteBatchExamMarkController@student_exam_result');
                Route::get('/single-student-exam-result/{id}','Management\Institute\InstituteBatchExamMarkController@single_student_exam_result');
                Route::post('/exam-result-submit','Management\Institute\InstituteBatchExamMarkController@result_submit');
                Route::post('/store','Management\Institute\InstituteBatchExamMarkController@store');
                Route::post('/update','Management\Institute\InstituteBatchExamMarkController@update');
                Route::post('/destroy','Management\Institute\InstituteBatchExamMarkController@destroy');
                Route::get('/{id}','Management\Institute\InstituteBatchExamMarkController@show');
            });

            // institute class batch api routes
            Route::group(['prefix' => 'institute/student'], function () {
                Route::get('/all','Management\Institute\InstituteStudentController@all');
                Route::post('/store','Management\Institute\InstituteStudentController@store');
                Route::post('/update','Management\Institute\InstituteStudentController@update');
                Route::post('/soft-delete','Management\Institute\InstituteStudentController@soft_delete');
                Route::post('/restore','Management\Institute\InstituteStudentController@restore');
                Route::post('/destroy','Management\Institute\InstituteStudentController@destroy');
                Route::get('/{id}','Management\Institute\InstituteStudentController@show');
            });

            // institute employee batch api routes
            Route::group(['prefix' => 'employee'], function () {
                Route::get('/all','Management\Institute\EmployeeController@all');
                Route::post('/store','Management\Institute\EmployeeController@store');
                Route::post('/update','Management\Institute\EmployeeController@update');
                Route::post('/soft-delete','Management\Institute\EmployeeController@soft_delete');
                Route::post('/restore','Management\Institute\EmployeeController@restore');
                Route::post('/destroy','Management\Institute\EmployeeController@destroy');
                Route::get('/{id}','Management\Institute\EmployeeController@show');
            });

            // student payment api routes
            Route::group(['prefix' => 'student/payments'], function () {
                Route::get('/all','Management\Payment\StudentPaymentController@all');
                Route::post('/store','Management\Payment\StudentPaymentController@store');
                Route::post('/update','Management\Payment\StudentPaymentController@update');
                Route::post('/soft-delete','Management\Payment\StudentPaymentController@soft_delete');
                Route::post('/restore','Management\Payment\StudentPaymentController@restore');
                Route::post('/destroy','Management\Payment\StudentPaymentController@destroy');
                Route::get('/{id}','Management\Payment\StudentPaymentController@show');
            });

             // student attendence api routes
            Route::group(['prefix' => 'attendence/student'], function () {
                Route::post('/class-wise-batch','Management\Institute\AttendenceController@class_wise_batch');
                Route::post('/get_subjects', 'Management\Institute\AttendenceController@get_subjects');
                Route::post('/batch-wise-students','Management\Institute\AttendenceController@batch_wise_students');
                Route::post('/student-attendence','Management\Institute\AttendenceController@student_attendence');
                Route::get('/attendence-students','Management\Institute\AttendenceController@attendence_students');
                Route::get('/single_student_attendence','Management\Institute\AttendenceController@single_student_attendence');
                Route::get('/single-student-attendence/{id}','Management\Institute\AttendenceController@single_student_attendence_by_id');
                Route::post('/student_monthly_attendence','Management\Institute\AttendenceController@student_monthly_attendence');
                Route::get('/{id}','Management\Institute\AttendenceController@show');
            });

             // employee attendence api routes
            Route::group(['prefix' => 'attendence/employee'], function () {
                Route::get('/all','Management\Institute\EmployeeAttendenceController@all');
                Route::post('/employee-attendence','Management\Institute\EmployeeAttendenceController@employee_attendence');
                Route::post('/employee-attendence-update','Management\Institute\EmployeeAttendenceController@employee_attendence_udpate');
                Route::post('/class-wise-batch','Management\Institute\EmployeeAttendenceController@class_wise_batch');
                Route::post('/batch-wise-students','Management\Institute\EmployeeAttendenceController@batch_wise_students');

                Route::get('/single_teacher_attendence','Management\Institute\EmployeeAttendenceController@single_teacher_attendence');
                Route::post('/teacher_monthly_attendence','Management\Institute\EmployeeAttendenceController@teacher_monthly_attendence');

                Route::post('/student-attendence','Management\Institute\EmployeeAttendenceController@student_attendence');
                Route::get('/attendence-students','Management\Institute\EmployeeAttendenceController@attendence_students');
                Route::get('/{id}','Management\Institute\EmployeeAttendenceController@show');
            });

        });
        
    }
   
);

Route::get('get_schedule/{id}', 'Controllers\WebsiteController@get_schedules');