<?php


Route::group(["prefix" => "admin", 'as' => 'admin.', "middleware" => ['AuthRedirectTo:admin.login','role:owner']], function()
{


	Route::group([], function()
	{
		Route::get('/', function(){
			return redirect()->route('admin.dashboard');
		});

		Route::get('/dashboard', [ 'as' => "dashboard", "uses" => "DashboardController@index" ]);

	});

	
});