<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/homepage', 'homepageCont@index'); //Homepage routing
Route::get('/user/details','user\detailprofileCont@detailpage'); //Detailpage routing
Route::get('/login', 'accountController@login'); //Loginpage routing

Route::post('/register', 'accountController@store'); //Register account to DB
Route::post('/login', 'accountController@signinAcc'); //LoginCHeck routing
Route::get('/logout', 'accountController@logOut'); //Logout

//Admin Page
Route::get('/admin-homepage', 'homepageCont@index');
Route::get('/register', 'accountController@register'); //Registerpage routing

//User Page
Route::get('/user/edit','user\detailprofileCont@editpage'); //Detailpage routing
Route::get('/user/changepassword','user\detailprofileCont@changepass'); //Detailpage routing
Route::post('/user/changepassword','user\detailprofileCont@updatepass'); //Update Password routing
Route::post('/user/edit','user\detailprofileCont@editImage'); //Update Image routing
