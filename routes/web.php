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


Route::get('/login', 'accountController@login'); //Loginpage routing
Route::get('/logout', 'accountController@logOut'); //Logout
Route::post('/register', 'accountController@store'); //Register account to DB
Route::post('/login', 'accountController@signinAcc'); //LoginCHeck routing

//Admin Page
Route::get('/admin-homepage', 'admin\adminPageController@index');
Route::get('/register', 'accountController@register'); //Registerpage routing
Route::get('/admin-profile', 'admin\adminPageController@profilepage'); 
Route::get('/admin-edit', 'admin\adminPageController@editpage'); 
Route::get('/admin-changepassword', 'admin\adminPageController@changepwpage'); 
Route::get('/admin-adduser', 'admin\adminPageController@adduserpage'); 
Route::get('/admin-listuser', 'admin\adminPageController@listuserpage'); 
Route::post('/admin-edit','admin\adminPageController@editImageAdmin'); //Update Image routing
Route::post('/admin-changepassword','admin\adminPageController@updatepw'); //Update Password routing

//User Page
Route::get('/homepage', 'homepageCont@index'); //Homepage routing
Route::get('/user/edit','user\detailprofileCont@editpage'); //Detailpage routing
Route::get('/user/changepassword','user\detailprofileCont@changepass'); //Detailpage routing
Route::get('/user/details','user\detailprofileCont@detailpage'); //Detailpage routing
Route::post('/user/changepassword','user\detailprofileCont@updatepass'); //Update Password routing
Route::post('/user/edit','user\detailprofileCont@editImage'); //Update Image routing