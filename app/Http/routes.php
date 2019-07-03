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

Route::get('sign-in/{provider}', 'SocialController@redirect')->where('provider','twitter|facebook|linkedin|google');
Route::get('sign-in/{provider}/callback','SocialController@Callback')->where('provider','twitter|facebook|linkedin|google');

Route::get('sign-in', 'SignController@signinPage')->name('singin');
Route::post('sign-in', 'SignController@signin')->name('singin_post');
Route::get('sign-up', 'SignController@signupPage')->name('singup');
Route::post('sign-up', 'SignController@signup')->name('singup_post');
Route::get('validation', 'SignController@validationPage')->name('validation');
Route::post('validation', 'SignController@validation')->name('validation_post');


/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';
