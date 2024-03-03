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

        Route::group(['prefix' => '/course', 'middleware' => ['guest:api']], function () {
            Route::get('/all-types', 'WebsiteController@all_types');
            Route::get('/all-course', 'WebsiteController@all_course');
            Route::get('/type-wise-course', 'WebsiteController@type_wise_course');
        });
        

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
            Route::group(['prefix' => 'user'], function () {
                Route::post('/api-logout', 'Auth\ApiLoginController@logout');
                Route::post('/user_info', 'Auth\ApiLoginController@user_info');
                Route::post('/check-auth', 'Auth\ApiLoginController@check_auth');
                Route::post('/user_update', 'Auth\ApiLoginController@user_update');
                Route::post('/update_password', 'Auth\ApiLoginController@update_password');
                Route::post('/find-user-info', 'Auth\ApiLoginController@find_user_info');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::post('/update-profile', 'Auth\ProfileController@update_profile');
                Route::get('/all', 'Auth\UserController@all');
                Route::get('/{id}', 'Auth\UserController@show');
                Route::post('/store', 'Auth\UserController@store');
                Route::post('/canvas-store', 'Auth\UserController@canvas_store');
                Route::post('/update', 'Auth\UserController@update');
                Route::post('/soft-delete', 'Auth\UserController@soft_delete');
                Route::post('/destroy', 'Auth\UserController@destroy');
                Route::post('/restore', 'Auth\UserController@restore');
                Route::post('/bulk-import', 'Auth\UserController@bulk_import');
            });

            Route::group(['prefix' => 'user-role'], function () {
                Route::get('/all', 'Auth\UserRoleController@all');
                Route::post('/store', 'Auth\UserRoleController@store');
                Route::post('/canvas-store', 'Auth\UserRoleController@canvas_store');
                Route::post('/update', 'Auth\UserRoleController@update');
                Route::post('/canvas-update', 'Auth\UserRoleController@canvas_update');
                Route::post('/soft-delete', 'Auth\UserRoleController@soft_delete');
                Route::post('/destroy', 'Auth\UserRoleController@destroy');
                Route::post('/restore', 'Auth\UserRoleController@restore');
                Route::post('/bulk-import', 'Auth\UserRoleController@bulk_import');
                Route::get('/{id}', 'Auth\UserRoleController@show');
            });

            Route::group(['prefix' => 'contact-message'], function () {
                Route::get('/all', 'Admin\ContactMessageController@all');
                Route::post('/store', 'Admin\ContactMessageController@store');
                Route::post('/canvas-store', 'Admin\ContactMessageController@canvas_store');
                Route::post('/update', 'Admin\ContactMessageController@update');
                Route::post('/canvas-update', 'Admin\ContactMessageController@canvas_update');
                Route::post('/soft-delete', 'Admin\ContactMessageController@soft_delete');
                Route::post('/destroy', 'Admin\ContactMessageController@destroy');
                Route::post('/restore', 'Admin\ContactMessageController@restore');
                Route::post('/bulk-import', 'Admin\ContactMessageController@bulk_import');
                Route::get('/{id}', 'Admin\ContactMessageController@show');
            });
        });

        Route::group(['prefix' => '', 'middleware' => ['guest:api']], function () {

            Route::group(['prefix' => 'course'], function () {
                Route::get('/all', 'Course\CourseController@all');
                Route::post('/store', 'Course\CourseController@store');
                Route::post('/canvas-store', 'Course\CourseController@canvas_store');
                Route::post('/update', 'Course\CourseController@update');
                Route::post('/canvas-update', 'Course\CourseController@canvas_update');
                Route::post('/soft-delete', 'Course\CourseController@soft_delete');
                Route::post('/destroy', 'Course\CourseController@destroy');
                Route::post('/restore', 'Course\CourseController@restore');
                Route::post('/bulk-import', 'Course\CourseController@bulk_import');
                Route::get('/{id}', 'Course\CourseController@show');

                Route::group(['prefix' => 'course-category'], function () {
                    Route::get('/all', 'Course\CourseCategoryController@all');
                    Route::post('/store', 'Course\CourseCategoryController@store');
                    Route::post('/canvas-store', 'Course\CourseCategoryController@canvas_store');
                    Route::post('/update', 'Course\CourseCategoryController@update');
                    Route::post('/canvas-update', 'Course\CourseCategoryController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseCategoryController@soft_delete');
                    Route::post('/destroy', 'Course\CourseCategoryController@destroy');
                    Route::post('/restore', 'Course\CourseCategoryController@restore');
                    Route::post('/bulk-import', 'Course\CourseCategoryController@bulk_import');
                    Route::get('/{id}', 'Course\CourseCategoryController@show');
                });

                Route::group(['prefix' => 'course-instructor'], function () {
                    Route::get('/all', 'Course\CourseInstructorController@all');
                    Route::post('/store', 'Course\CourseInstructorController@store');
                    Route::post('/canvas-store', 'Course\CourseInstructorController@canvas_store');
                    Route::post('/update', 'Course\CourseInstructorController@update');
                    Route::post('/canvas-update', 'Course\CourseInstructorController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseInstructorController@soft_delete');
                    Route::post('/destroy', 'Course\CourseInstructorController@destroy');
                    Route::post('/restore', 'Course\CourseInstructorController@restore');
                    Route::post('/bulk-import', 'Course\CourseInstructorController@bulk_import');
                    Route::get('/{id}', 'Course\CourseInstructorController@show');
                });

                Route::group(['prefix' => 'course-batch'], function () {
                    Route::get('/all', 'Course\CourseBatchController@all');
                    Route::post('/store', 'Course\CourseBatchController@store');
                    Route::post('/canvas-store', 'Course\CourseBatchController@canvas_store');
                    Route::post('/update', 'Course\CourseBatchController@update');
                    Route::post('/canvas-update', 'Course\CourseBatchController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseBatchController@soft_delete');
                    Route::post('/destroy', 'Course\CourseBatchController@destroy');
                    Route::post('/restore', 'Course\CourseBatchController@restore');
                    Route::post('/bulk-import', 'Course\CourseBatchController@bulk_import');
                    Route::get('/{id}', 'Course\CourseBatchController@show');
                });

                Route::group(['prefix' => 'course-essential-requirements'], function () {
                    Route::get('/all', 'Course\CourseEssentialRequirementsController@all');
                    Route::post('/store', 'Course\CourseEssentialRequirementsController@store');
                    Route::post('/canvas-store', 'Course\CourseEssentialRequirementsController@canvas_store');
                    Route::post('/update', 'Course\CourseEssentialRequirementsController@update');
                    Route::post('/canvas-update', 'Course\CourseEssentialRequirementsController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseEssentialRequirementsController@soft_delete');
                    Route::post('/destroy', 'Course\CourseEssentialRequirementsController@destroy');
                    Route::post('/restore', 'Course\CourseEssentialRequirementsController@restore');
                    Route::post('/bulk-import', 'Course\CourseEssentialRequirementsController@bulk_import');
                    Route::get('/{id}', 'Course\CourseEssentialRequirementsController@show');
                });

                Route::group(['prefix' => 'course-faqs'], function () {
                    Route::get('/all', 'Course\CourseFaqsController@all');
                    Route::post('/store', 'Course\CourseFaqsController@store');
                    Route::post('/canvas-store', 'Course\CourseFaqsController@canvas_store');
                    Route::post('/update', 'Course\CourseFaqsController@update');
                    Route::post('/canvas-update', 'Course\CourseFaqsController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseFaqsController@soft_delete');
                    Route::post('/destroy', 'Course\CourseFaqsController@destroy');
                    Route::post('/restore', 'Course\CourseFaqsController@restore');
                    Route::post('/bulk-import', 'Course\CourseFaqsController@bulk_import');
                    Route::get('/{id}', 'Course\CourseFaqsController@show');
                });

                Route::group(['prefix' => 'course-for-whoms'], function () {
                    Route::get('/all', 'Course\CourseForWhomsController@all');
                    Route::post('/store', 'Course\CourseForWhomsController@store');
                    Route::post('/canvas-store', 'Course\CourseForWhomsController@canvas_store');
                    Route::post('/update', 'Course\CourseForWhomsController@update');
                    Route::post('/canvas-update', 'Course\CourseForWhomsController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseForWhomsController@soft_delete');
                    Route::post('/destroy', 'Course\CourseForWhomsController@destroy');
                    Route::post('/restore', 'Course\CourseForWhomsController@restore');
                    Route::post('/bulk-import', 'Course\CourseForWhomsController@bulk_import');
                    Route::get('/{id}', 'Course\CourseForWhomsController@show');
                });

                Route::group(['prefix' => 'course-job-position'], function () {
                    Route::get('/all', 'Course\CoursejobPositionController@all');
                    Route::post('/store', 'Course\CoursejobPositionController@store');
                    Route::post('/canvas-store', 'Course\CoursejobPositionController@canvas_store');
                    Route::post('/update', 'Course\CoursejobPositionController@update');
                    Route::post('/canvas-update', 'Course\CoursejobPositionController@canvas_update');
                    Route::post('/soft-delete', 'Course\CoursejobPositionController@soft_delete');
                    Route::post('/destroy', 'Course\CoursejobPositionController@destroy');
                    Route::post('/restore', 'Course\CoursejobPositionController@restore');
                    Route::post('/bulk-import', 'Course\CoursejobPositionController@bulk_import');
                    Route::get('/{id}', 'Course\CoursejobPositionController@show');
                });

                Route::group(['prefix' => 'course-job-work'], function () {
                    Route::get('/all', 'Course\CourseJobWorkController@all');
                    Route::post('/store', 'Course\CourseJobWorkController@store');
                    Route::post('/canvas-store', 'Course\CourseJobWorkController@canvas_store');
                    Route::post('/update', 'Course\CourseJobWorkController@update');
                    Route::post('/canvas-update', 'Course\CourseJobWorkController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseJobWorkController@soft_delete');
                    Route::post('/destroy', 'Course\CourseJobWorkController@destroy');
                    Route::post('/restore', 'Course\CourseJobWorkController@restore');
                    Route::post('/bulk-import', 'Course\CourseJobWorkController@bulk_import');
                    Route::get('/{id}', 'Course\CourseJobWorkController@show');
                });

                Route::group(['prefix' => 'course-what-you-will-get'], function () {
                    Route::get('/all', 'Course\CourseWhatYouWillGetController@all');
                    Route::post('/store', 'Course\CourseWhatYouWillGetController@store');
                    Route::post('/canvas-store', 'Course\CourseWhatYouWillGetController@canvas_store');
                    Route::post('/update', 'Course\CourseWhatYouWillGetController@update');
                    Route::post('/canvas-update', 'Course\CourseWhatYouWillGetController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseWhatYouWillGetController@soft_delete');
                    Route::post('/destroy', 'Course\CourseWhatYouWillGetController@destroy');
                    Route::post('/restore', 'Course\CourseWhatYouWillGetController@restore');
                    Route::post('/bulk-import', 'Course\CourseWhatYouWillGetController@bulk_import');
                    Route::get('/{id}', 'Course\CourseWhatYouWillGetController@show');
                });

                Route::group(['prefix' => 'course-why-you-learn-from-us'], function () {
                    Route::get('/all', 'Course\CourseWhyYouLearnFromUsController@all');
                    Route::post('/store', 'Course\CourseWhyYouLearnFromUsController@store');
                    Route::post('/canvas-store', 'Course\CourseWhyYouLearnFromUsController@canvas_store');
                    Route::post('/update', 'Course\CourseWhyYouLearnFromUsController@update');
                    Route::post('/canvas-update', 'Course\CourseWhyYouLearnFromUsController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseWhyYouLearnFromUsController@soft_delete');
                    Route::post('/destroy', 'Course\CourseWhyYouLearnFromUsController@destroy');
                    Route::post('/restore', 'Course\CourseWhyYouLearnFromUsController@restore');
                    Route::post('/bulk-import', 'Course\CourseWhyYouLearnFromUsController@bulk_import');
                    Route::get('/{id}', 'Course\CourseWhyYouLearnFromUsController@show');
                });

                Route::group(['prefix' => 'course-you-will-learns'], function () {
                    Route::get('/all', 'Course\CourseYouWillLearnsController@all');
                    Route::post('/store', 'Course\CourseYouWillLearnsController@store');
                    Route::post('/canvas-store', 'Course\CourseYouWillLearnsController@canvas_store');
                    Route::post('/update', 'Course\CourseYouWillLearnsController@update');
                    Route::post('/canvas-update', 'Course\CourseYouWillLearnsController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseYouWillLearnsController@soft_delete');
                    Route::post('/destroy', 'Course\CourseYouWillLearnsController@destroy');
                    Route::post('/restore', 'Course\CourseYouWillLearnsController@restore');
                    Route::post('/bulk-import', 'Course\CourseYouWillLearnsController@bulk_import');
                    Route::get('/{id}', 'Course\CourseYouWillLearnsController@show');
                });

                Route::group(['prefix' => 'course-modules'], function () {
                    Route::get('/all', 'Course\CourseModulesController@all');
                    Route::post('/store', 'Course\CourseModulesController@store');
                    Route::post('/canvas-store', 'Course\CourseModulesController@canvas_store');
                    Route::post('/update', 'Course\CourseModulesController@update');
                    Route::post('/canvas-update', 'Course\CourseModulesController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModulesController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModulesController@destroy');
                    Route::post('/restore', 'Course\CourseModulesController@restore');
                    Route::post('/bulk-import', 'Course\CourseModulesController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModulesController@show');
                });

                Route::group(['prefix' => 'course-modules-class-exams'], function () {
                    Route::get('/all', 'Course\CourseModuleClassExamsController@all');
                    Route::post('/store', 'Course\CourseModuleClassExamsController@store');
                    Route::post('/canvas-store', 'Course\CourseModuleClassExamsController@canvas_store');
                    Route::post('/update', 'Course\CourseModuleClassExamsController@update');
                    Route::post('/canvas-update', 'Course\CourseModuleClassExamsController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModuleClassExamsController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModuleClassExamsController@destroy');
                    Route::post('/restore', 'Course\CourseModuleClassExamsController@restore');
                    Route::post('/bulk-import', 'Course\CourseModuleClassExamsController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModuleClassExamsController@show');
                });

                Route::group(['prefix' => 'course-modules-class-quiz'], function () {
                    Route::get('/all', 'Course\CourseModuleClassQuizesController@all');
                    Route::post('/store', 'Course\CourseModuleClassQuizesController@store');
                    Route::post('/canvas-store', 'Course\CourseModuleClassQuizesController@canvas_store');
                    Route::post('/update', 'Course\CourseModuleClassQuizesController@update');
                    Route::post('/canvas-update', 'Course\CourseModuleClassQuizesController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModuleClassQuizesController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModuleClassQuizesController@destroy');
                    Route::post('/restore', 'Course\CourseModuleClassQuizesController@restore');
                    Route::post('/bulk-import', 'Course\CourseModuleClassQuizesController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModuleClassQuizesController@show');
                });

                Route::group(['prefix' => 'course-modules-class-resourse'], function () {
                    Route::get('/all', 'Course\CourseModuleClassResoursesController@all');
                    Route::post('/store', 'Course\CourseModuleClassResoursesController@store');
                    Route::post('/canvas-store', 'Course\CourseModuleClassResoursesController@canvas_store');
                    Route::post('/update', 'Course\CourseModuleClassResoursesController@update');
                    Route::post('/canvas-update', 'Course\CourseModuleClassResoursesController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModuleClassResoursesController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModuleClassResoursesController@destroy');
                    Route::post('/restore', 'Course\CourseModuleClassResoursesController@restore');
                    Route::post('/bulk-import', 'Course\CourseModuleClassResoursesController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModuleClassResoursesController@show');
                });

                Route::group(['prefix' => 'course-modules-class-routines'], function () {
                    Route::get('/all', 'Course\CourseModuleClassRoutinesController@all');
                    Route::post('/store', 'Course\CourseModuleClassRoutinesController@store');
                    Route::post('/canvas-store', 'Course\CourseModuleClassRoutinesController@canvas_store');
                    Route::post('/update', 'Course\CourseModuleClassRoutinesController@update');
                    Route::post('/canvas-update', 'Course\CourseModuleClassRoutinesController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModuleClassRoutinesController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModuleClassRoutinesController@destroy');
                    Route::post('/restore', 'Course\CourseModuleClassRoutinesController@restore');
                    Route::post('/bulk-import', 'Course\CourseModuleClassRoutinesController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModuleClassRoutinesController@show');
                });

                Route::group(['prefix' => 'course-modules-class'], function () {
                    Route::get('/all', 'Course\CourseModuleClassController@all');
                    Route::post('/store', 'Course\CourseModuleClassController@store');
                    Route::post('/canvas-store', 'Course\CourseModuleClassController@canvas_store');
                    Route::post('/update', 'Course\CourseModuleClassController@update');
                    Route::post('/canvas-update', 'Course\CourseModuleClassController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModuleClassController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModuleClassController@destroy');
                    Route::post('/restore', 'Course\CourseModuleClassController@restore');
                    Route::post('/bulk-import', 'Course\CourseModuleClassController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModuleClassController@show');
                });

                Route::group(['prefix' => 'course-modules-at-a-glances'], function () {
                    Route::get('/all', 'Course\CourseModulesAtAGlancesController@all');
                    Route::post('/store', 'Course\CourseModulesAtAGlancesController@store');
                    Route::post('/canvas-store', 'Course\CourseModulesAtAGlancesController@canvas_store');
                    Route::post('/update', 'Course\CourseModulesAtAGlancesController@update');
                    Route::post('/canvas-update', 'Course\CourseModulesAtAGlancesController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModulesAtAGlancesController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModulesAtAGlancesController@destroy');
                    Route::post('/restore', 'Course\CourseModulesAtAGlancesController@restore');
                    Route::post('/bulk-import', 'Course\CourseModulesAtAGlancesController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModulesAtAGlancesController@show');
                });

                Route::group(['prefix' => 'course-modules-task-complete-by-users'], function () {
                    Route::get('/all', 'Course\CourseModuleTaskCompleteByUsersController@all');
                    Route::post('/store', 'Course\CourseModuleTaskCompleteByUsersController@store');
                    Route::post('/canvas-store', 'Course\CourseModuleTaskCompleteByUsersController@canvas_store');
                    Route::post('/update', 'Course\CourseModuleTaskCompleteByUsersController@update');
                    Route::post('/canvas-update', 'Course\CourseModuleTaskCompleteByUsersController@canvas_update');
                    Route::post('/soft-delete', 'Course\CourseModuleTaskCompleteByUsersController@soft_delete');
                    Route::post('/destroy', 'Course\CourseModuleTaskCompleteByUsersController@destroy');
                    Route::post('/restore', 'Course\CourseModuleTaskCompleteByUsersController@restore');
                    Route::post('/bulk-import', 'Course\CourseModuleTaskCompleteByUsersController@bulk_import');
                    Route::get('/{id}', 'Course\CourseModuleTaskCompleteByUsersController@show');
                });
            });

            Route::group(['prefix' => 'blog'], function () {
                Route::get('/all', 'Blog\BlogController@all');
                Route::post('/store', 'Blog\BlogController@store');
                Route::post('/canvas-store', 'Blog\BlogController@canvas_store');
                Route::post('/update', 'Blog\BlogController@update');
                Route::post('/canvas-update', 'Blog\BlogController@canvas_update');
                Route::post('/soft-delete', 'Blog\BlogController@soft_delete');
                Route::post('/destroy', 'Blog\BlogController@destroy');
                Route::post('/restore', 'Blog\BlogController@restore');
                Route::post('/bulk-import', 'Blog\BlogController@bulk_import');
                Route::get('/{id}', 'Blog\BlogController@show');

                Route::group(['prefix' => 'category'], function () {
                    Route::get('/all', 'Blog\BlogCategoriesController@all');
                    Route::post('/store', 'Blog\BlogCategoriesController@store');
                    Route::post('/canvas-store', 'Blog\BlogCategoriesController@canvas_store');
                    Route::post('/update', 'Blog\BlogCategoriesController@update');
                    Route::post('/canvas-update', 'Blog\BlogCategoriesController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogCategoriesController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogCategoriesController@destroy');
                    Route::post('/restore', 'Blog\BlogCategoriesController@restore');
                    Route::post('/bulk-import', 'Blog\BlogCategoriesController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogCategoriesController@show');
                });

                Route::group(['prefix' => 'blog-meta'], function () {
                    Route::get('/all', 'Blog\BlogMetaController@all');
                    Route::post('/store', 'Blog\BlogMetaController@store');
                    Route::post('/canvas-store', 'Blog\BlogMetaController@canvas_store');
                    Route::post('/update', 'Blog\BlogMetaController@update');
                    Route::post('/canvas-update', 'Blog\BlogMetaController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogMetaController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogMetaController@destroy');
                    Route::post('/restore', 'Blog\BlogMetaController@restore');
                    Route::post('/bulk-import', 'Blog\BlogMetaController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogMetaController@show');
                });

                Route::group(['prefix' => 'blog-comment-replies'], function () {
                    Route::get('/all', 'Blog\BlogCommentRepliesController@all');
                    Route::post('/store', 'Blog\BlogCommentRepliesController@store');
                    Route::post('/canvas-store', 'Blog\BlogCommentRepliesController@canvas_store');
                    Route::post('/update', 'Blog\BlogCommentRepliesController@update');
                    Route::post('/canvas-update', 'Blog\BlogCommentRepliesController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogCommentRepliesController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogCommentRepliesController@destroy');
                    Route::post('/restore', 'Blog\BlogCommentRepliesController@restore');
                    Route::post('/bulk-import', 'Blog\BlogCommentRepliesController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogCommentRepliesController@show');
                });

                Route::group(['prefix' => 'blog-comment'], function () {
                    Route::get('/all', 'Blog\BlogCommentsController@all');
                    Route::post('/store', 'Blog\BlogCommentsController@store');
                    Route::post('/canvas-store', 'Blog\BlogCommentsController@canvas_store');
                    Route::post('/update', 'Blog\BlogCommentsController@update');
                    Route::post('/canvas-update', 'Blog\BlogCommentsController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogCommentsController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogCommentsController@destroy');
                    Route::post('/restore', 'Blog\BlogCommentsController@restore');
                    Route::post('/bulk-import', 'Blog\BlogCommentsController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogCommentsController@show');
                });

                Route::group(['prefix' => 'blog-tags'], function () {
                    Route::get('/all', 'Blog\BlogCommentsController@all');
                    Route::post('/store', 'Blog\BlogCommentsController@store');
                    Route::post('/canvas-store', 'Blog\BlogCommentsController@canvas_store');
                    Route::post('/update', 'Blog\BlogCommentsController@update');
                    Route::post('/canvas-update', 'Blog\BlogCommentsController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogCommentsController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogCommentsController@destroy');
                    Route::post('/restore', 'Blog\BlogCommentsController@restore');
                    Route::post('/bulk-import', 'Blog\BlogCommentsController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogCommentsController@show');
                });

                Route::group(['prefix' => 'blog-video-link'], function () {
                    Route::get('/all', 'Blog\BlogVideoLinksController@all');
                    Route::post('/store', 'Blog\BlogVideoLinksController@store');
                    Route::post('/canvas-store', 'Blog\BlogVideoLinksController@canvas_store');
                    Route::post('/update', 'Blog\BlogVideoLinksController@update');
                    Route::post('/canvas-update', 'Blog\BlogVideoLinksController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogVideoLinksController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogVideoLinksController@destroy');
                    Route::post('/restore', 'Blog\BlogVideoLinksController@restore');
                    Route::post('/bulk-import', 'Blog\BlogVideoLinksController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogVideoLinksController@show');
                });


                Route::group(['prefix' => 'blog-view'], function () {
                    Route::get('/all', 'Blog\BlogViewController@all');
                    Route::post('/store', 'Blog\BlogViewController@store');
                    Route::post('/canvas-store', 'Blog\BlogViewController@canvas_store');
                    Route::post('/update', 'Blog\BlogViewController@update');
                    Route::post('/canvas-update', 'Blog\BlogViewController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogViewController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogViewController@destroy');
                    Route::post('/restore', 'Blog\BlogViewController@restore');
                    Route::post('/bulk-import', 'Blog\BlogViewController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogViewController@show');
                });

                Route::group(['prefix' => 'blog-writers'], function () {
                    Route::get('/all', 'Blog\BlogWritersController@all');
                    Route::post('/store', 'Blog\BlogWritersController@store');
                    Route::post('/canvas-store', 'Blog\BlogWritersController@canvas_store');
                    Route::post('/update', 'Blog\BlogWritersController@update');
                    Route::post('/canvas-update', 'Blog\BlogWritersController@canvas_update');
                    Route::post('/soft-delete', 'Blog\BlogWritersController@soft_delete');
                    Route::post('/destroy', 'Blog\BlogWritersController@destroy');
                    Route::post('/restore', 'Blog\BlogWritersController@restore');
                    Route::post('/bulk-import', 'Blog\BlogWritersController@bulk_import');
                    Route::get('/{id}', 'Blog\BlogWritersController@show');
                });
            });

            Route::group(['prefix' => 'seminar'], function () {
                // Route::get('/all', 'seminar\SeminarController@all');
                // Route::post('/store', 'seminar\SeminarController@store');
                // Route::post('/canvas-store', 'seminar\SeminarController@canvas_store');
                // Route::post('/update', 'seminar\SeminarController@update');
                // Route::post('/canvas-update', 'seminar\SeminarController@canvas_update');
                // Route::post('/soft-delete', 'seminar\SeminarController@soft_delete');
                // Route::post('/destroy', 'seminar\SeminarController@destroy');
                // Route::post('/restore', 'seminar\SeminarController@restore');
                // Route::post('/bulk-import', 'seminar\SeminarController@bulk_import');
                // Route::get('/{id}', 'seminar\SeminarController@show');

                Route::group(['prefix' => 'seminar-participants'], function () {
                    // Route::get('/all', 'seminar\SeminarParticipantsController@all');
                    // Route::post('/store', 'seminar\SeminarParticipantsController@store');
                    // Route::post('/canvas-store', 'seminar\SeminarParticipantsController@canvas_store');
                    // Route::post('/update', 'seminar\SeminarParticipantsController@update');
                    // Route::post('/canvas-update', 'seminar\SeminarParticipantsController@canvas_update');
                    // Route::post('/soft-delete', 'seminar\SeminarParticipantsController@soft_delete');
                    // Route::post('/destroy', 'seminar\SeminarParticipantsController@destroy');
                    // Route::post('/restore', 'seminar\SeminarParticipantsController@restore');
                    // Route::post('/bulk-import', 'seminar\SeminarParticipantsController@bulk_import');
                    // Route::get('/{id}', 'seminar\SeminarParticipantsController@show');
                });

            });

            Route::group(['prefix' => 'my-course'], function () {
                Route::get('/current-course', 'Api\CourseApiController@currentCourse');


            });
        });
    }
);

Route::post('/tests', function () {
    return request()->all();
});

Route::get('/demodata', function () {
    return ["name" => "demodata", "time" => Carbon\Carbon::now()->toDateTimeString()];
});
