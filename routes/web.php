<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
 This File Created By Ahmed Magdy - For Brokerage Task Test -- 14/11/2019@7:14PM
*/

//Must Be Auth To Login DashBoard
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
//Restfull API
Route::resource('/customers', 'customersController');
Route::resource('/actions', 'actionsController');

Auth::routes();
