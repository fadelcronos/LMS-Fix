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


Route::get('/', 'accountController@test'); //Loginpage routing

Route::get('/login', 'accountController@login'); //Loginpage routing
Route::get('/logout', 'accountController@logOut'); //Logout
Route::get('/register', 'accountController@register'); //Registerpage routing
Route::post('/register', 'accountController@store'); //Register account to DB
Route::post('/check-kpk', 'accountController@checkKpk'); //Register account to DB
Route::post('/login', 'accountController@signinAcc'); //LoginCHeck routing
Route::get('/forgot-password', 'forgotPassword@forgotpage'); //Forgotpass routing
Route::post('/forgot-password', 'forgotPassword@getotp'); //Forgotpass routing
Route::post('/forgot-changepassword', 'forgotPassword@checkotp'); //OTP Checking routing
Route::post('/changepass', 'forgotPassword@updatepass'); //ChangePass Forgot routing

//Admin Page
Route::get('/admin-homepage', 'admin\adminPageController@index');
Route::get('/admin-profile', 'admin\adminPageController@profilepage'); 
Route::get('/admin-edit', 'admin\adminPageController@editpage'); 
Route::get('/admin-changepassword', 'admin\adminPageController@changepwpage'); 
Route::get('/admin-adduser', 'admin\adminPageController@adduserpage'); 
Route::get('/admin-listuser', 'admin\adminPageController@listuserpage'); 
Route::post('/admin-edit','admin\adminPageController@editImageAdmin'); //Update Image routing
Route::post('/admin-changepassword','admin\adminPageController@updatepw'); //Update Password routing

//User Page
Route::get('/homepage', 'user\detailprofileCont@index'); //Homepage routing
Route::get('/user/edit','user\detailprofileCont@editpage'); //Detailpage routing
Route::get('/user/changepassword','user\detailprofileCont@changepass'); //Detailpage routing
Route::get('/user/details','user\detailprofileCont@detailpage'); //Detailpage routing
Route::post('/user/changepassword','user\detailprofileCont@updatepass'); //Update Password routing
Route::post('/user/edit','user\detailprofileCont@editImage'); //Update Image routing 

//Kaizen 
Route::get('/kaizen-form/add-kaizen','kaizenform\KaizenCont@userkaipage'); //Add Kai user routing
Route::post('/kaizen-form/add-kaizen','kaizenform\KaizenCont@store'); //
Route::get('/kaizen-form/list-kaizen','kaizenform\KaizenCont@listkaipage'); //
Route::get('/kaizen-form/list-kaizen/action','kaizenform\KaizenCont@searchkaizen')->name('actionlist'); //Search fetures in list kaizen page

Route::post('/kaizen-form/list-kaizen','kaizenform\KaizenCont@searchkaizen'); //Add Kai user routing
// Route::post('/kaizen-form/list-kaizen','kaizenform\KaizenCont@testSearch')->name('livesearch'); //Add Kai user routing

Route::get('/kaizen-form/update-kaizen','kaizenform\KaizenCont@updatelist'); //Add Kai user routing
Route::get('/kaizen-form/update-kaizen/{kzid}','kaizenform\KaizenCont@show'); //Add Kai user routing
Route::post('/kaizen-form/update-kaizen','kaizenform\KaizenCont@updatedetaildata'); //Update detail kaizen data routing

Route::get('/kaizen-form/approval-kaizen','kaizenform\KaizenCont@listapprove'); //list kaizen to be approved
Route::get('/kaizen-form/approval-kaizen/action','kaizenform\KaizenCont@searchApprove')->name('actionapproval'); //Search kaizen in approval page
Route::get('/kaizen-form/attendance-kaizen','kaizenform\KaizenCont@attendancepage'); //Attendance page kaizen
Route::get('/kaizen-form/attendance-kaizen/action','kaizenform\KaizenCont@searchData')->name('actionattendance'); //Search kaizen data on attendance page

Route::get('/kaizen-form/attendance-kaizen/{kzid}','kaizenform\KaizenCont@attendancedetail'); //get detail of a kaizen attendance
Route::post('/kaizen-form/attendance-kaizen','kaizenform\KaizenCont@searchData'); //list kaizen to be approved
Route::post('/kaizen-form/attendance','kaizenform\KaizenCont@attendancesubmit'); //list kaizen to be approved
Route::get('/kaizen-form/approval-kaizen/{kzid}','kaizenform\KaizenCont@approvalpage'); //approved spesific kaizen and set room for kaizen
Route::post('/kaizen-form/approval-kaizen','kaizenform\KaizenCont@approvemail'); //approved kaizen to execute mail

Route::get('/kaizen-form/cancel-kaizen/{kzid}','kaizenform\KaizenCont@cancelkaizen'); //cancel kaizen route
Route::get('/kaizen-form/apr-kaizen/{kzid}','kaizenform\KaizenCont@approvekaizen'); //approve kaizen route


Route::get('/kaizen-form/test','kaizenform\KaizenCont@testmail'); //approved kaizen
Route::get('/kaizen-form/dashboard','kaizenform\KaizenCont@comingsoon'); //Dashboard Kaizen Page

Route::post('/kaizen-form/add-finding','kaizenform\KaizenCont@addFinding')->name('addFinding'); //list kaizen to be approved

Route::get('/kaizen-form/delete-finding/{fid}','kaizenform\KaizenCont@deleteFinding'); //delete finding

Route::post('/kaizen-form/edit-finding','kaizenform\KaizenCont@editFinding')->name('editFinding'); //edit finding
// Route::get('/test','kaizenform\KaizenCont@testKaiPage'); //approved kaizen
// Route::get('/test/action','kaizenform\KaizenCont@testSearch')->name('actionsearch'); //approved kaizen

