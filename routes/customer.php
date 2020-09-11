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

Route::prefix('customer')->name('customer.')->namespace('Customer')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('user','UserController');
    Route::get('user/destroy/{id}', 'UserController@destroy');
    Route::get('user/activedeactive/{id}/{status}', 'UserController@activedeactive');
    Route::post('user/addresspassword','UserController@addresspassword');

    Route::get('profile','UserController@profile')->name('profile');
    Route::post('user/updateaccount','UserController@updateaccount');
    Route::post('user/changepassword','UserController@changepassword');

    Route::resource('social_account','SocialAccountController');
    Route::get('facebook','SocialAccountController@facebook')->name('facebook');
    Route::get('facebookcallback','SocialAccountController@facebookcallback')->name('facebookcallback');
    Route::get('social_account/destroy/{id}', 'SocialAccountController@destroy');

    Route::get('twitter','SocialAccountController@twitter')->name('twitter');
    Route::get('twittercallback','SocialAccountController@twittercallback')->name('twittercallback');

    Route::get('instagram', 'SocialAccountController@instagram')->name('instagram');
    Route::get('instagramcallback', 'SocialAccountController@instagramcallback')->name('instagramcallback');

    Route::resource('media','MediaController');
    Route::post('copyFile','MediaController@copyFile')->name('copyFile');
	
	// submit and view tickets
//    Route::get('tickets','TicketsController@index')->name('tickets');
//    Route::post('add_ticket','TicketsController@addTicket')->name('add_ticket');
//    Route::get('ticket_detail','TicketsController@getDetail')->name('ticket_detail');


    Route::post('add_ticket_replies', 'TicketsController@addTicketReplies')->name('add_ticket_replies');
    // ticket email
    Route::get('check_tickets','TicketsController@checkTickets')->name('check_tickets');
	Route::resource('/captions', 'CaptionController');
    Route::post('/username/{id}', 'LinkTreeController@checkUser')->name('check.username');
    Route::resource('/social-collection', 'LinkTreeController');
    Route::get('/customwebsite', 'LinkTreeController@customWebsite')->name('website');
    Route::resource('/social_links', 'SocialLinksController');
	Route::post('/social_links/unlink', 'SocialLinksController@unlink')->name('unlink');
    Route::resource('/statistics', 'FeedController');
    // submit and view tickets
    Route::get('tickets','TicketsController@index')->name('tickets');
    Route::post('add_ticket','TicketsController@addTicket')->name('add_ticket');
    Route::get('ticket_detail','TicketsController@getDetail')->name('ticket_detail');
    Route::post('dropzone/store', 'DropzoneController@dropzoneStore')->name('dropzone.store');
    Route::resource('/analysis', 'ButtonStatisticController');

});

