<?php

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

Auth::logout();

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('/', 'WelcomeController@index');

	Route::resource('user', 'UserController');
	Route::resource('league', 'LeagueController');
	Route::resource('invitation', 'InvitationController');
	Route::resource('season', 'SeasonController');
	Route::resource('draft', 'DraftController');
	Route::resource('group', 'GroupController');
	Route::resource('event', 'EventController');
	Route::resource('rating', 'RatingController');

	/** Private Untappd Calls **/
	Route::get('/untappd/brewery/{term}', 'UntappdController@brewery')->name('untappd.brewery');

	Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
