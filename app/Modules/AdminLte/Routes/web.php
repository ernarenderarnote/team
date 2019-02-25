<?php


Route::group(["prefix" => "admin", "as" => "admin."], function(){

	Route::group([ "namespace" => "Auth" ], function()
	{

		Route::match(['get', 'post'], '/login', [ 'as' => 'login', "uses" => "LoginController@login"] );
		Route::group([ 'prefix' => "password", 'as' => 'password.' ], function()
		{

			Route::match(['get','post'], '/forgot', [ 'as' => 'forgot', 'uses' => "ForgotPasswordController@forgot"]);
			Route::match(['get','post'], '/reset/{token}', [ 'as' => 'reset', "uses" => "ResetPasswordController@reset"]);

		});
		
		Route::get('/logout', [ 'as' => 'logout', "uses" => "LoginController@logout"] );
		
	});
	

});



