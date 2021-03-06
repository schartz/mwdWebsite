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

Route::get('/greet/{userName}', function($userName){
    return "Hello, " . $userName;
});

Route::get('/about', 'StaticPagesController@about');

Route::get('/tuts', 'TutorialController@list');

Route::get('/users/list', 'UsersController@listUsers');