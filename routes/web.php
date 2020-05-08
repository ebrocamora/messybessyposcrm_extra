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

/**
 * Auth routes
 */
Route::get('/redirect', 'Auth\LoginController@redirect')->name('login');
Route::get('/auth/callback', 'Auth\LoginController@callback')->name('auth.callback');
Route::get('/auth/user', 'Auth\LoginController@getUserInfo')->name('auth.user');
Route::get('/logout/callback', 'Auth\LoginController@loggedOutCallback')->name('logout.callback');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');