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

// DASHBOARD
Route::get('/home', 'HomeController@index')->name('home');

// CARS ROUTES
Route::get('/cars', 'CarsController@cars');
Route::post('/cars/new', 'CarsController@newCar');
Route::post('/cars/edit', 'CarsController@editCar');
Route::post('/cars/remove', 'CarsController@removeCar');

// NEW CAR FORM
Route::get('/newcar', 'CreatorController@constructNewCar');
Route::post('/postnewcar', 'CreatorController@postNewCar');

// NEW MEMBER REGISTRATION
Route::post('/postnewmembership', 'CreatorController@postNewMembership');

// JOIN CAR ROUTE
Route::get('/joincar', 'CreatorController@constructJoinCar');
Route::post('/joinselector', 'CreatorController@joinSelector');
Route::post('/postjoincar', 'CreatorController@postJoinCar');

Route::get('/createCars/images', 'CarsController@carpic');

// GET AND SHOW MEMBERS
Route::get('/members/get', 'MemberController@getMembers');
Route::post('/members/new', 'MemberController@newMember');
Route::post('/members/edit', 'MemberController@editMember');
Route::post('/members/remove', 'MemberController@removeMember');

//UPLOAD NEW CAR IMAGE
Route::get('/uploadinterface', 'UploadController@interface');
Route::post('/upload-img', 'UploadController@imageUpload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
