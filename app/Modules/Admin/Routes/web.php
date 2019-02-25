<?php


Route::group(["prefix" => "admin", "as" => "admin.",'middleware'=> ['AuthRedirectTo:admin.login','role:owner']] , function()
{

	Route::resource('{type}/user', 'UserController');
	Route::resource('{type}/faq', 'FAQController');
	Route::resource('{type}/support', 'SupportController');


	Route::group(["as" => "support.", "prefix" => "support"], function(){
		Route::resource('{type}/subject', "SupportSubjectController" );
		Route::resource('{type}/contact', "SupportContactController" );
	});


	Route::group(["prefix" => "employer", "as" => "employer.", "namespace" => "Employer"], function(){
		Route::resource("school", "SchoolController");
		Route::resource("contactpacks", "ContactPackController");
	});

	//++++++++++++JK--------------
	Route::get('/state', ['as' => 'state', 'uses' =>'StateAndCityController@getState']);
	Route::match(['get', 'post'], '/add-state', ['as' => 'add-state', 'uses' => 'StateAndCityController@addNewState']);
	Route::get('/city', ['as' => 'city', 'uses' =>'StateAndCityController@getCity']);
	Route::match(['get', 'post'], '/add-city', ['as' => 'add-city', 'uses' => 'StateAndCityController@addNewCity']);
});