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
	    Route::post('resendConfirmationCode', ['as'=>'resendConfirmationCode','uses' => 'Api\SignupController@resendConfirmationCode']);


		//forgot pass forgotPassword
		Route::post('forgotPassword', ['as'=>'forgotPassword','uses' => 'Api\UserController@forgotPassword']);

		//invites user
		Route::post('inviteUser', ['as'=>'inviteUser','uses' => 'Api\UserController@inviteUser']);

		//user ban request
		Route::post('userBanRequest', ['as'=>'userBanRequest','uses' => 'Api\UserBannedController@userBanRequest']);


		//location
	    Route::get('country', ['as'=>'country','uses' => 'Api\LocationController@countryList']);
	    Route::get('city', ['as'=>'city','uses' => 'Api\LocationController@cityList']);

		//Post type and subType
		Route::get('postType', ['as'=>'postType','uses' => 'Api\PostTypeController@postType']);
		Route::get('postSubType', ['as'=>'postSubType','uses' => 'Api\PostTypeController@postSubType']);

		//post
	    Route::post('topicPost', ['as'=>'topicPost','uses' => 'Api\PostTopicController@topicPost']);
	    Route::post('helpPost', ['as'=>'helpPost','uses' => 'Api\PostHelpController@helpPost']);
	    Route::post('campaignPost', ['as'=>'campaignPost','uses' => 'Api\PostCampaignController@campaignPost']);
	    Route::post('reportPost', ['as'=>'reportPost','uses' => 'Api\PostReportController@reportPost']);

	   //single post view
		Route::get('singlePost', ['as'=>'singlePost','uses' => 'Api\NewsFeedController@singlePost']);
		Route::get('userPost', ['as'=>'userPost','uses' => 'Api\UserController@userPost']);



		//single post comment
		Route::get('unsupportComment', ['as'=>'unsupportComment','uses' => 'Api\CommentController@unsupportComment']);
		Route::get('supportComment', ['as'=>'supportComment','uses' => 'Api\CommentController@supportComment']);

		Route::get('postsSubComment', ['as'=>'postsSubComment','uses' => 'Api\CommentController@postsSubComment']);


		//post delete
		Route::post('postDelete', ['as'=>'postDelete','uses' => 'Api\PostSolvedController@postDelete']);


		//comment post
		Route::post('comment', ['as'=>'comment','uses' => 'Api\CommentController@commentStore']);
		Route::post('subComment', ['as'=>'subComment','uses' => 'Api\CommentController@subCommentStore']);
		//comment check
		Route::get('checkCommentStatus', ['as'=>'checkCommentStatus','uses' => 'Api\CommentController@checkCommentStatus']);



		//post solved
		Route::post('postSolved', ['as'=>'postSolved','uses' => 'Api\PostSolvedController@postSolved']);

		//follow
		Route::post('follow', ['as'=>'follow','uses' => 'Api\FollowerController@follow']);
		Route::post('unFollow', ['as'=>'unFollow','uses' => 'Api\FollowerController@unFollow']);

		Route::get('followerList', ['as'=>'followerList','uses' => 'Api\FollowerController@followerList']);
		Route::get('followingList', ['as'=>'followingList','uses' => 'Api\FollowerController@followingList']);
		Route::get('isFollowing', ['as'=>'isFollowing','uses' => 'Api\FollowerController@isFollowing']);

	     Route::get('showFollowerRequest', ['as'=>'showFollowerRequest','uses' => 'Api\FollowerController@showFollowerRequest']);
	     Route::post('acceptFollowerRequest', ['as'=>'acceptFollowerRequest','uses' => 'Api\FollowerController@acceptFollowerRequest']);
	     Route::post('rejectFollowerRequest', ['as'=>'rejectFollowerRequest','uses' => 'Api\FollowerController@rejectFollowerRequest']);


		//newsFeed
	    Route::get('newsFeed', ['as'=>'newsFeed','uses' => 'Api\NewsFeedController@newsFeed']); //query problem

		//discover
	    Route::get('discover', ['as'=>'discover','uses' => 'Api\DiscoverController@discover']);
	    Route::get('discoverCategoryPost', ['as'=>'discoverCategoryPost','uses' => 'Api\DiscoverController@discoverCategoryPost']);

		//User profile
	     Route::get('userProfile', ['as'=>'userProfile','uses' => 'Api\UserController@userProfile']);


		//Interest
	    Route::post('interestPostType', ['as'=>'interestPostType','uses' => 'Api\InterestController@interestPostType']);
	    Route::get('showInterest', ['as'=>'showInterest','uses' => 'Api\InterestController@showInterest']);
	    Route::get('removeInterest', ['as'=>'removeInterest','uses' => 'Api\InterestController@removeInterest']);

		//search
		Route::get('searchPostOrUser', ['as'=>'searchPostOrUser','uses' => 'Api\SearchController@searchPostOrUser']);
		Route::get('searchDiscover', ['as'=>'searchDiscover','uses' => 'Api\SearchController@searchDiscover']);



		//save post
		Route::post('savePostByUser', ['as'=>'savePostByUser','uses' => 'Api\SavePostController@savePostByUser']);
		Route::get('savePostView', ['as'=>'savePostView','uses' => 'Api\SavePostController@savePostView']);
		Route::post('removeSavePost', ['as'=>'removeSavePost','uses' => 'Api\SavePostController@removeSavePost']);

		//participate
		Route::post('postParticipate', ['as'=>'postParticipate','uses' => 'Api\ParticipateController@postParticipate']);
		Route::get('viewParticipate', ['as'=>'viewParticipate','uses' => 'Api\ParticipateController@viewParticipate']);
		Route::get('checkParticipateStatus', ['as'=>'checkParticipateStatus','uses' => 'Api\ParticipateController@checkParticipateStatus']);


		//Gcm
	    Route::post('gcmStore', ['as'=>'gcmStore','uses' => 'Api\GcmController@gcmStore']);
	    Route::get('logout', ['as'=>'logout','uses' => 'Api\GcmController@logout']);


	  //setting
	  Route::post('updateUsername', ['as'=>'updateUsername','uses' => 'Api\ProfileSettingController@updateUsername']);
	  Route::post('updateEmail', ['as'=>'updateEmail','uses' => 'Api\ProfileSettingController@updateEmail']);
	  Route::post('updatePassword', ['as'=>'updatePassword','uses' => 'Api\ProfileSettingController@updatePassword']);
	  Route::post('updateMobile', ['as'=>'updateMobile','uses' => 'Api\ProfileSettingController@updateMobile']);
	  Route::post('updateName', ['as'=>'updateName','uses' => 'Api\ProfileSettingController@updateName']);
	  Route::post('updateOccupation', ['as'=>'updateOccupation','uses' => 'Api\ProfileSettingController@updateOccupation']);
	  Route::post('updateWorkPlace', ['as'=>'updateWorkPlace','uses' => 'Api\ProfileSettingController@updateWorkPlace']);
	  Route::post('updateCity', ['as'=>'updateCity','uses' => 'Api\ProfileSettingController@updateCity']);
	  Route::post('updateCountry', ['as'=>'updateCountry','uses' => 'Api\ProfileSettingController@updateCountry']);
	  Route::post('changeProfileImage', ['as'=>'changeProfileImage','uses' => 'Api\ProfileSettingController@changeProfileImage']);



});













Route::get('test', ['as'=>'test','uses' => 'Api\UserController@test']);









































//
//Route::get('profile1',function(){
//	return View::make('template.profile')->with('title','Profile');
//});
//
//Route::get('timeline',function(){
//	return View::make('template.timeline')->with('title','Timeline');
//});
//
//Route::get('widgets',function(){
//	return View::make('template.widgets')->with('title','Widgets');
//});
//
//Route::get('portlets',function(){
//	return View::make('template.portlets')->with('title','Portlets');
//});
//
//Route::get('panel',function(){
//	return View::make('template.panel')->with('title','Panel');
//});
//
//Route::get('chart_x',function(){
//	return View::make('template.chart_x')->with('title','Chart_x');
//});
//
//
//Route::get('index2',function(){
//	return View::make('template.dashboard')->with('title','Dashboard');
//});
//
//Route::get('gmap',function(){
//	return View::make('template.gmap')->with('title','GMap');
//});
//
//Route::get('friends',function(){
//	return View::make('template.friends')->with('title','Friends');
//});
//
//Route::get('adForm',function(){
//	return View::make('template.advanced_form')->with('title','Advanced Form');//problem
//});
//
//Route::get('form-wizard',function(){
//	return View::make('template.form_wizard')->with('title','Form Wizard');
//});
//
//
//Route::get('dataTable',function(){
//	return View::make('template.datatable')->with('title','Data Table');
//});
//
//
//Route::get('EditableDataTable',function(){
//	return View::make('template.editDataTable')->with('title','Editable Data Table');
//});
//
//
//
