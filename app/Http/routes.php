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

// API Endpoints
Route::group(array('prefix' => 'api/v1'), function ()
{
	Route::resource('campaign', 'ApiV1\CampaignController');
	Route::resource('emails', 'ApiV1\EmailsController');
	Route::resource('events', 'ApiV1\CampaignEventsController');
	Route::any('web-hooks', 'ApiV1\WebHooksController@index');
});

// Queue Consumers
Route::group(array('prefix' => 'queue-consumers'), function ()
{
	Route::any('setup', ['as'=>'queueConsumerSetup', 'uses'=>'QueueConsumers\SetupController@index']);
	Route::any('email-send', ['as'=>'queueConsumerEmailSend', 'uses'=>'QueueConsumers\EmailsController@index']);
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);