<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index')->name('home');

/* sign-up / sign-in / validation */
Route::get('sign-in/{provider}', 'SocialController@redirect')->where('provider','twitter|facebook|linkedin|google');
Route::get('sign-in/{provider}/callback','SocialController@Callback')->where('provider','twitter|facebook|linkedin|google');

Route::get('sign-in', 'SignController@signinPage')->name('singin');
Route::post('sign-in', 'SignController@signin')->name('singin_post');
Route::get('sign-up', 'SignController@signupPage')->name('singup');
Route::post('sign-up', 'SignController@signup')->name('singup_post');
Route::get('validation', 'SignController@validationPage')->name('validation');
Route::post('validation', 'SignController@validation')->name('validation_post');


/* profile */
Route::get('profile', 'ProfileSettingsController@profilePage')->name('profile');
Route::get('profile/edit', 'ProfileSettingsController@profileEditPage')->name('profile_edit');
Route::post('profile/edit', 'ProfileSettingsController@profileEdit')->name('profile_edit_post');
Route::get('profile/{id}', 'ProfileSettingsController@profilePage')->name('profile_other');
Route::get('transaction-history', 'ProfileSettingsController@transactionHistoryPage')->name('transaction_history');
Route::post('save-geo-data', 'ProfileSettingsController@saveGeo')->name('save_geo_post');
Route::post('save-share', 'ProfileSettingsController@saveShare')->name('save_share_post');
Route::post('save-push-notification-token', 'ProfileSettingsController@savePushNotificationToken')->name('save_push_notification_token_post');
Route::get('phone-validation', 'ProfileSettingsController@phoneValidationPage')->name('phone-validation');
Route::post('phone-validation', 'ProfileSettingsController@phoneValidation')->name('phone-validation_post');

/* settings */
Route::get('settings', 'ProfileSettingsController@settingsPage')->name('settings');
Route::get('settings/edit', 'ProfileSettingsController@settingsEditPage')->name('settings_edit');
Route::post('settings/edit', 'ProfileSettingsController@settingsEdit')->name('settings_edit_post');
Route::get('settings/credits', 'ProfileSettingsController@settingsCreditsPage')->name('settings_credits');
Route::get('settings/credits/checkout', 'ProfileSettingsController@settingsCreditsCheckoutPage')->name('settings_credits_checkout');
Route::post('settings/credits/checkout', 'ProfileSettingsController@settingsCreditsCheckout')->name('settings_credits_checkout_post');

Route::get('notifications', 'NotificationsController@notificationsPage')->name('notifications');

/* feeds */
Route::get('feeds', 'FeedsController@feedsPage')->name('feeds');
Route::post('feeds', 'FeedsController@feeds')->name('feeds_post');


/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';

/* ================== Custom Admin Routes ================== */
$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
    $as = config('laraadmin.adminRoute').'.';
    // Routes for Laravel 5.3
    Route::get('/logout', 'Auth\LoginController@logout');
}
Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
    /* ================== Custom User_Transactions ================== */
    Route::get(config('laraadmin.adminRoute') . '/user_transactions/add/new', 'LA\User_TransactionsController@add_transaction_page');
    Route::get(config('laraadmin.adminRoute') . '/user_transactions/add/{purchase_id}', 'LA\User_TransactionsController@add_transaction_page');
    Route::get(config('laraadmin.adminRoute') . '/user_transactions/add/{purchase_id}/{mode}', 'LA\User_TransactionsController@add_transaction_save')->where('mode', 'automatic|manual');;
    Route::post(config('laraadmin.adminRoute') . '/user_transactions/add/{purchase_id}/{mode}', 'LA\User_TransactionsController@add_transaction_save')->where('mode', 'automatic|manual');;
    Route::post(config('laraadmin.adminRoute') . '/user_transactions/add/new', 'LA\User_TransactionsController@add_transaction_save');

    Route::get(config('laraadmin.adminRoute') . '/users_notifications/add/new', 'LA\Users_NotificationsController@add_notification_page');
    Route::post(config('laraadmin.adminRoute') . '/users_notifications/add/new', 'LA\Users_NotificationsController@add_notification_save');
});
