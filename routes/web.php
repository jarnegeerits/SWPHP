<?php

use Illuminate\Support\Facades\Route;
// use RealRashid\SweetAlert\Facades\Alert;
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

Route::get('/', 'LandingController@landingLoad');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cars', 'HomeController@cars');
Route::get('/members', 'HomeController@members');
