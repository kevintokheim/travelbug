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

/**
 * Home
 */
 
Route::get('/', [
	'uses' => '\travelbug\Http\Controllers\HomeController@index',
	'as' => 'home',
]);

Route::get('/alert', function(){
	return redirect()->route('home')->with('info', 'You have signed up.');
});

/**
 * Authentification
 */

//Sign Up
Route::get('/signup', [
	'uses' => '\travelbug\Http\Controllers\AuthController@getSignUp',
	'as' => 'auth.signup',
	'middleware' => ['guest'],
]);

Route::post('/signup', [
	'uses' => '\travelbug\Http\Controllers\AuthController@postSignUp',
	'middleware' => ['guest'],
]);

//Sign In
Route::get('/signin', [
	'uses' => '\travelbug\Http\Controllers\AuthController@getSignIn', 
	'as' => 'auth.signin',
	'middleware' => ['guest'],
]);

Route::post('/signin', [
	'uses' => '\travelbug\Http\Controllers\AuthController@postSignIn',
	'middleware' => ['guest'],
]);

//Sign Out
Route::get('/signout', [
	'uses' => '\travelbug\Http\Controllers\AuthController@getSignout',
	'as' => 'auth.signout',
]);

/**
 * Search
 */
 
 Route::get('/search', [
	'uses' => '\travelbug\Http\Controllers\SearchController@getResults',
	'as' => 'search.results',
 ]);
 
 /**
  * Profile
  */
  
  Route::get('/user/{username}', [
	'uses' => '\travelbug\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile.index',
  ]);
  
  //Update Profile
  Route::get('/profile/edit', [
	'uses' => '\travelbug\Http\Controllers\ProfileController@getEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
  ]);
  
  Route::post('/profile/edit', [
	'uses' => '\travelbug\Http\Controllers\ProfileController@postEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
  ]);






