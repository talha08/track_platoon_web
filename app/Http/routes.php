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

Route::get('/', function () {
	return Redirect::route('login');
});


Route::group(['middleware' => 'guest'], function(){
	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'Auth\AuthController@login']);
	Route::get('user/create', ['as'=>'user.create','uses' => 'UsersController@create']);
	Route::post('user/store', ['as'=>'user.store','uses' => 'UsersController@store']);
	Route::post('login', array('uses' => 'Auth\AuthController@doLogin'));

	//Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'Auth\AuthController@dashboard'));
	// social login route
	Route::get('login/fb', ['as'=>'login/fb','uses' => 'SocialController@loginWithFacebook']);
	Route::get('login/gp', ['as'=>'login/gp','uses' => 'SocialController@loginWithGoogle']);

});





Route::group(array('middleware' => 'auth'), function()
{

	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
	Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'Auth\AuthController@dashboard'));
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'Auth\AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'Auth\AuthController@doChangePassword'));


});





/*********************************************************
//api section
 ********************************************************/

// social login route
Route::group([ 'prefix' => 'api/v2/'], function(){

		//login api
		Route::post('loginWithSocial', ['as'=>'loginWithSocial','uses' => 'Api\LoginController@loginWithSocial']);
		Route::post('loginNormal', ['as'=>'login/email','uses' => 'Api\LoginController@normalLogin']);


		//sign up api
		Route::post('register', ['as'=>'register','uses' => 'Api\SignupController@register']);
	    Route::post('confirmAccount', ['as'=>'confirmAccount','uses' => 'Api\SignupController@confirmAccount']);


		//user ban request
		Route::post('userBanRequest', ['as'=>'userBanRequest','uses' => 'Api\UserBannedController@userBanRequest']);


		//location
	    Route::get('country', ['as'=>'country','uses' => 'Api\LocationController@countryList']);
	    Route::get('city', ['as'=>'city','uses' => 'Api\LocationController@cityList']);


		//post
	    Route::post('topicPost', ['as'=>'topicPost','uses' => 'Api\PostTopicController@topicPost']);
	    Route::post('helpPost', ['as'=>'helpPost','uses' => 'Api\PostHelpController@helpPost']);
	    Route::post('campaignPost', ['as'=>'campaignPost','uses' => 'Api\PostCampaignController@campaignPost']);
	    Route::post('reportPost', ['as'=>'reportPost','uses' => 'Api\PostReportController@reportPost']);

		//comment
	    Route::post('comment', ['as'=>'comment','uses' => 'Api\CommentController@commentStore']);
});



















Route::get('test', function () {
	return  \App\ApiModel\Post::all();
});















Route::get('profile1',function(){
	return View::make('template.profile')->with('title','Profile');
});

Route::get('timeline',function(){
	return View::make('template.timeline')->with('title','Timeline');
});

Route::get('widgets',function(){
	return View::make('template.widgets')->with('title','Widgets');
});

Route::get('portlets',function(){
	return View::make('template.portlets')->with('title','Portlets');
});

Route::get('panel',function(){
	return View::make('template.panel')->with('title','Panel');
});

Route::get('chart_x',function(){
	return View::make('template.chart_x')->with('title','Chart_x');
});


Route::get('index2',function(){
	return View::make('template.dashboard')->with('title','Dashboard');
});

Route::get('gmap',function(){
	return View::make('template.gmap')->with('title','GMap');
});

Route::get('friends',function(){
	return View::make('template.friends')->with('title','Friends');
});

Route::get('adForm',function(){
	return View::make('template.advanced_form')->with('title','Advanced Form');//problem
});

Route::get('form-wizard',function(){
	return View::make('template.form_wizard')->with('title','Form Wizard');
});


Route::get('dataTable',function(){
	return View::make('template.datatable')->with('title','Data Table');
});


Route::get('EditableDataTable',function(){
	return View::make('template.editDataTable')->with('title','Editable Data Table');
});



