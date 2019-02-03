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

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('/', 'WelcomeController@index');

	Route::resource('user', 'UserController');
	Route::get('/user/attendance/{event}', 'UserController@attendance');
	Route::resource('league', 'LeagueController');
	Route::resource('rules', 'LeagueRuleController')
		->only(['edit', 'update', 'show'])
		->parameters(['rules' => 'league']);
	Route::get('leagueuser/{league}', 'LeagueUserController@update')->name('leagueuser.update');
	Route::delete('leagueuser/{league}/{user}', 'LeagueUserController@destroy')->name('leagueuser.destroy');

	Route::resource('survey', 'SurveyController');
	Route::resource('invitation', 'InvitationController');
	Route::resource('season', 'SeasonController');
	Route::resource('draft', 'DraftController');
	Route::resource('group', 'GroupController');
	Route::resource('event', 'EventController');
	Route::get('/event/{event}/score', 'EventController@score');
	Route::resource('rating', 'RatingController');

	/** Private Untappd Calls **/
	Route::get('/untappd/brewery/{term}', 'UntappdController@brewery')->name('untappd.brewery');
	Route::get('/untappd/beer/{term}', 'UntappdController@beer')->name('untappd.beer');

	Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
