<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');
Route::get('files/{id}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';

	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {

	/* ================== Dashboard ================== */

	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');

	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
    Route::get(config('laraadmin.adminRoute') . '/administrators', 'LA\UsersController@index');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');

	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');

	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');

	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');





	/* ================== Jobs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/jobs', 'LA\JobsController');
	Route::get(config('laraadmin.adminRoute') . '/job_dt_ajax', 'LA\JobsController@dtajax');

	/* ================== Validation_statuses ================== */
	Route::resource(config('laraadmin.adminRoute') . '/validation_statuses', 'LA\Validation_statusesController');
	Route::get(config('laraadmin.adminRoute') . '/validation_status_dt_ajax', 'LA\Validation_statusesController@dtajax');

	/* ================== User_Educations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/user_educations', 'LA\User_EducationsController');
	Route::get(config('laraadmin.adminRoute') . '/user_education_dt_ajax', 'LA\User_EducationsController@dtajax');

	/* ================== User_certifications ================== */
	Route::resource(config('laraadmin.adminRoute') . '/user_certifications', 'LA\User_certificationsController');
	Route::get(config('laraadmin.adminRoute') . '/user_certification_dt_ajax', 'LA\User_certificationsController@dtajax');

	/* ================== User_Purchases ================== */
	Route::resource(config('laraadmin.adminRoute') . '/user_purchases', 'LA\User_PurchasesController');
	Route::get(config('laraadmin.adminRoute') . '/user_purchase_dt_ajax', 'LA\User_PurchasesController@dtajax');

	/* ================== User_Transactions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/user_transactions', 'LA\User_TransactionsController');
	Route::get(config('laraadmin.adminRoute') . '/user_transaction_dt_ajax', 'LA\User_TransactionsController@dtajax');

	/* ================== Notifications ================== */
	Route::resource(config('laraadmin.adminRoute') . '/notifications', 'LA\NotificationsController');
	Route::get(config('laraadmin.adminRoute') . '/notification_dt_ajax', 'LA\NotificationsController@dtajax');

	/* ================== Users_Notifications ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users_notifications', 'LA\Users_NotificationsController');
	Route::get(config('laraadmin.adminRoute') . '/users_notification_dt_ajax', 'LA\Users_NotificationsController@dtajax');
});
