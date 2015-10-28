<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));
Route::post('/api/weather', array('as' => 'weather', 'uses' => 'ApiController@postWeather'));
Route::post('/api/location', array('as' => 'location', 'uses' => 'ApiController@postLocation'));
Route::post('/slack', array('as' => 'slack', 'uses' => 'ApiController@postSlack'));
Route::get('{location}', array('as' => 'home', 'uses' => 'HomeController@getIndex'));
