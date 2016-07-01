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

Route::get('/','WelcomeController@welcome');

Route::post('/',function (Request $request) {

    
    return ;
});


Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/home/search','HomeController@search');

Route::get('/home/{id}','HomeController@show');

Route::post('home/{id}','GoodController@store');

Route::patch('home/{id}/{good_id}','GoodController@update');

Route::get('/home/{id}/create','GoodController@create');

Route::get('/home/{id}/{good_id}/edit','GoodController@edit');

Route::get('home/{id}/{good_id}/destroy','GoodController@destroy');

Route::get('home/{id}/{good_id}/show','GoodController@show');

Route::get('home/{id}/{good_id}/IntoCart','CartController@create');

Route::get('/showCart','CartController@show');

Route::get('/showOrder','OrderController@show');

Route::get('/destroyCart/{user_id}','CartController@destroy');

Route::get('/SuccessfulPay',function (){
    return view('SuccessfulPay');
});