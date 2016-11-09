<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/init','InitController@init');


Route::get('/tst', function () {
    echo Entrust::routeNeedsPermission('admin', 'doc');




});

Route::resource('users','UsersController');
Route::resource('emp','EmpController');
Route::resource('doc','DocController');
Route::resource('patient','PatientController');
Route::resource('drug','DrugController');
Route::resource('brand','BrandController');
Route::resource('pharmacy','DrugSalesController');
Route::resource('booking','BookingController');
Route::resource('schedule','ScheduleController');
Route::resource('history','HistoryController');
Route::resource('labitems','LabItemController');
Route::resource('labtest','LabTestController');
Route::resource('lab','LabController');
Route::resource('expense','ExpenseController');
Route::resource('income','IncomeController');
Route::get('notification/drug','NotificationController@getDrugData');
Route::get('notification/item','NotificationController@getItemData');
Route::get('notification/all','NotificationController@getData');

Auth::routes();

Route::get('/admin', function (){
    return view('admin.master');
})->middleware('auth');

Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/settings', 'Auth\ChangePasswordController@index');
Route::post('/settings', 'Auth\ChangePasswordController@change');


