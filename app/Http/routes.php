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
Route::group(['middleware' => ['web']], function () {
  Route::get('/',function() 
  {
    return View::make('home');
  });
  Route::get('products/new','ProductController@new_');
  Route::get('products/modify','ProductController@modify');
  Route::get('products/view','ProductController@all');
  Route::get('products/view/{id}','ProductController@view_id');
  Route::get('products/remove/{id}','ProductController@remove');
  
  
  Route::get('products/login','Auth/AuthController@getLogin');
  Route::post('products/login','Auth/AuthController@postLogin');
  Route::get('products/logout','Auth/AuthController@getLogout');
  Route::get('products/register','Auth/AuthController@getRegister');
  Route::post('products/register','Auth/AuthController@postRegister');
  
  Route::resource('products', 'ProductController');
  Route::post('user/{id}/edit', 'ProductController@update');
  Route::auth();
  Route::get('/home', 'HomeController@index');
});

