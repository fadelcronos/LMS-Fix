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
//Homepage routing
Route::get('/homepage', 'homepageCont@index');

//Detailpage routing
Route::get('/details', 'detailprofileCont@detailpage');

//Loginpage routing
Route::get('/login', 'accountController@login');

//Registerpage routing
Route::get('/register', 'accountController@register');

//Register account to DB
Route::post('/register', 'accountController@store');

