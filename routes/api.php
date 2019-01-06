<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Use Multipart Form data in your insomnia/Postmant REST client
Route::post('/tut/create', 'TutorialController@create');

Route::get('/tut/list', 'TutorialController@index');

// Use Form URL encoded data in Insomni/Postman rest client
Route::put('/tut/update', 'TutorialController@update');

Route::delete('/tut/delete/{tutId}', 'TutorialController@delete');

Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout');

//Route::get('me', 'Auth\AuthController@me')->middleware('auth:api');
