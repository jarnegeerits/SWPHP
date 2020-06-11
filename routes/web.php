<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
// Landing page
Route::get('/', 'LandingController@landingLoad');

Auth::routes();

// DASHBOARD ROUTES
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cars', 'CarsController@cars');
Route::get('/members', 'HomeController@members');

// NEW CAR FORM
Route::get('/newcar', 'CreatorController@constructNewCar');
Route::post('/postnewcar', 'CreatorController@postNewCar');

// NEW MEMBER FORM
Route::post('newmembership', 'CreatorController@constructNewMembership');
Route::post('/postnewmembership', 'CreatorController@postNewMembership');

// JOIN CAR ROUTE
Route::get('/joincar', 'CreatorController@constructJoinCar');

Route::get('/createCars/images', 'CarsController@carpic');


