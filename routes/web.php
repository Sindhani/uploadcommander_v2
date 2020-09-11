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
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('home', function () {
    // Retrieve a piece of data from the session...
    //$value = session('user');

    //Specifying a default value...
    // $value = session('user', $value);

    //Store a piece of data in the session...
    //session(['user' => $value]);
    return view('admin.dashboard.index');
});

Route::get('/{username}', 'Customer\SocialLinksController@userName')->name('username');
include_once 'admin.php';
include_once 'customer.php';
