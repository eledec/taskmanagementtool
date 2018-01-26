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

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();
Route::resource('todo','TodoController@index');

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

*/

//Redirect for front end
Route::get('/', function () {
     return redirect('/login');
});

Route::auth();

//Main page backened
Route::get('/home', 'HomeController@index');

//Tabs redirects
Route::get('addtodo', 'TodoController@create');

Route::get('dashboard', 'TodoController@show');

