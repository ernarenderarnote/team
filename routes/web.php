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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/thank-you', function(){
	return view('thanks');
})->name('thanks');

//Corn Job
Route::group(["namespace" => 'CronJob', "prefix" => "cron", "as" => "cron."], function(){
	Route::get("/remember-email", ["as"=> "remember", "uses" => "UserController@rememberCompleteSignUp"]);
});


Route::match(['get', 'post'],'/account/setup/{token}',['as' => 'account.setup', "uses" => 'User\AccountController@initSetup']);

Route::group([ 'prefix' => 'auth', "as" => "auth." , "namespace" => "Auth"],function()
{
	Route::post('/', [ 'as' => 'login', "uses" => "LoginController@login"] );
	Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
	Route::get('/confirmation/{token}', [ 'as' => "confirm", "uses"=> "RegisterController@confirmation"]);

	Route::group([ 'prefix' => "password", 'as' => 'password.' ], function()
	{

		Route::match(['get','post'], '/forgot', [ 'as' => 'forgot', 'uses' => "ForgotPasswordController@forgot"]);
		Route::match(['get','post'], '/reset/{token}', [ 'as' => 'reset', "uses" => "ResetPasswordController@reset"]);

	});
	
	Route::get('/educator', [ 'as' => 'educator', "uses" => "LoginController@login", "status" => "educator" ] );
	Route::get('/employer', [ 'as' => 'employer', "uses" => "LoginController@login", "status" => "employer" ] );

});

Route::group([ 'prefix' => 'signup', "as" => "signup." , "namespace" => "Auth"], function()
{
	Route::match(['GET', "POST"], '/employer', [ 'as' => 'employer', "uses" => "EmployerSignupController@signup" ] );
});

Route::group([ 'prefix' => 'signup', "as" => "signup." , "namespace" => "Auth"], function()
{

	Route::group(['prefix' => 'educator', "as" => "educator.", ], function()
	{
		Route::match(['GET', "POST"], '/step-1', [ 'as' => 'step', "uses" => "EducatorSignupController@step" ] );
		Route::match(['GET', "POST"], '/step-2', [ 'as' => 'step2', "uses" => "EducatorSignupController@step2" ] );
		Route::get('/step-3', [ 'as' => 'step3', "uses" => "EducatorSignupController@step3" ] );
		Route::match(['GET', "POST"], '/questionnaire', [ 'as' => 'questionnaire', "uses" => "EducatorSignupController@questionnaire" ]);
		
	});
	//Route::get('/employer', [ 'as' => 'employer', "uses" => "LoginController@login", "status" => "employer" ] );

	

});

Route::group(["middleware" => "auth", "namespace" => "Auth"], function(){
	Route::get("educator/resend/email", "EmployerSignupController@resendMail")->name("educator.resend.email");
	Route::get("employer/resend/email", "EducatorSignupController@resendMail")->name("employer.resend.email");
});

Route::group(["namespace" => "Dashboard" , "middleware" => ["auth", "role:employer|educator|client", "IsEduSetupCompleted"]], function()
{
	Route::get('/dashboard', [ "as" =>"dashboard", 'uses' => "DashboardController@index" ]);

});


Route::group([ 
	'prefix' => 'employer',	"as" => "employer." ,
	"namespace" => "Employer", "middleware" => ["AuthRedirectTo:auth.employer", "role:employer|client"] ], function(){

		Route::resource('jobs', 'JobController');

		

		Route::group(["as" => 'notification.', "prefix" => 'notification'], function(){
			//Route::post('/jobs', [ "as" => "jobs.read", "uses" => "NotificationController@readJobNotification" ]);
			Route::post('/alerts', [ "as" => "alerts.read", "uses" => "NotificationController@readAlertsNotification" ]);
		});

		Route::get("/credit/buy", "ContactPackController@index")->name("buy.credit");
		Route::post("/credit/pay", "ContactPackController@pay")->name("credit.pay");
		Route::any("/stripe/pay", "ContactPackController@stripePay")->name("stripe.pay");

		

		Route::get("/thank-you", function(){ 
			return view("employer.purchase-thankyou");
		})->name("thank.you");

		Route::get("/order-thank-you", function(){ 
			return view("employer.order-thank-you");
		})->name("order.thank.you");
		

		Route::resource('carts', 'CartController');
		Route::resource('history', 'HistoryController');
		Route::get('history/contact/{contact}', ["as" => "contact.view", "uses" => "HistoryController@contactView"]);
		Route::resource('support', 'SupportController');

		Route::get('educator-quich-search', ['as' => 'eductor-quick-search', 'uses' => 'EducatorSearchController@index']);
		Route::get('educator-view/{contact}', ['as' => 'educator.view', 'uses' => 'EducatorSearchController@educatorView']);
		Route::post('educator-request/{id}', ['as' => 'educator.contact.request', 'uses' => 'EducatorSearchController@requestContactDetails']);
		Route::get('educator-resume/{id}', ['as' => 'educator.resume', 'uses' => 'EducatorSearchController@viewResume']);

		Route::get('faq', ['as' => "faq", "uses" => "FaqController@index"]);
		
		Route::group(["middleware" => 'ClientHasPermission:administrator|pay approved'], function(){
			Route::resource('teammates', "TeamController");
			Route::get("/place/order", "CartController@placeOrder")->name("place.order");
			Route::resource("cards", "CardController");
			Route::post('/jobs/{job}/action/{userAction}', [ "as" => "jobs.action", "uses" => "JobController@jobStatusHandler"  ] );
		});
		Route::resource('settings', "SettingController");

		Route::match(["GET", "POST"],'settings/password/reset', ['as'=> "password.reset",'uses'=> 'SettingController@resetPassword']);

		Route::resource('transections', "TransectionController");
		
		//Route::match(['GET', "POST"], '/employer', [ 'as' => 'employer', "uses" => "EmployerSignupController@signup" ] );
});

Route::group([ 
	'prefix' => 'educator',	"as" => "educator." ,
	"namespace" => "Educator", "middleware" => ["AuthRedirectTo:auth.educator", "role:educator", "IsEduSetupCompleted"] ], function(){

		Route::resource('jobs', 'JobController');
		Route::get("/jobs/status/{status}",[ "as" => "jobs.status", "uses"  => "JobController@jobWithStatus" ])->where("status", '(approved|rejected)');
		Route::post('/jobs/{job}/action/{userAction}', [ "as" => "jobs.action", "uses" => "JobController@jobStatusHandler"  ] );

		Route::post('/contact/request/{id?}',"NotificationController@contactRequest" )->name("contact.request");

		Route::group(["as" => 'notification.', "prefix" => 'notification'], function(){
			Route::post('/jobs', [ "as" => "jobs.read", "uses" => "NotificationController@readJobNotification" ]);
			Route::post('/alerts', [ "as" => "alerts.read", "uses" => "NotificationController@readAlertsNotification" ]);
		});

		Route::resource('history', 'HistoryController');
		Route::resource('support', 'SupportController');
		Route::get('faq', ['as' => "faq", "uses" => "FaqController@index"]);

		Route::match(['GET',"POST"], 'settings/questionnaire/{user}', [ "as"=>"questionnaire", "uses" => "SettingController@questionnaire"]);

		Route::match(["GET", "POST"],'settings/password/reset', ['as'=> "password.reset",'uses'=> 'SettingController@resetPassword']);

		Route::resource('settings', "SettingController");


		//Route::match(['GET', "POST"], '/employer', [ 'as' => 'employer', "uses" => "EmployerSignupController@signup" ] );
});


//payment
Route::group(["prefix" => "paypal", "namespace" => "Employer"], function(){

	Route::any("successfully", "PaypalController@successfully");
	Route::any("cancelled", "PaypalController@cancelled");
	Route::any("notify", "PaypalController@notify");

});

