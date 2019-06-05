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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    
    // user 
    Route::get('/users/{user}/avatar', ['as' => 'users.avatar', 'uses' => 'UserController@getAvatar']);
    Route::post('/users/{user}/avatar', ['as' => 'users.update.avatar', 'uses' => 'UserController@updateAvatar']);
    Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);

    // reset password
    Route::put('/password', 'PasswordController@reset');

    // students
    Route::get('/students/{student}/avatar', ['as' => 'students.avatar', 'uses' => 'StudentController@getAvatar']);
    Route::post('/students/{student}/avatar', ['as' => 'students.update.avatar', 'uses' => 'StudentController@updateAvatar']);
    Route::resource('/students', 'StudentController');

    // settings
    Route::resource('/settings', 'StudentController');

    // contact
    Route::resource('/contact', 'StudentController', ['except' => ['create', 'edit', 'update']]);


});