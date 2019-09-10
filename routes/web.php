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

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users', 'UsersController@index');
    Route::get('/users/{user}', 'UsersController@details');
    Route::get('/invite', 'InviteController@index');
    Route::post('/invite', 'InviteController@store');

    Route::group(['middleware' => 'can:admin'], function () {
        Route::get('/admin/invitations/list', 'InvitationsController@index');
    });

    Route::group(['middleware' => 'can:write-post'], function () {
        Route::get('/posts/new', 'PostsController@create');
        Route::post('/posts/new', 'PostsController@store');
    });
});

