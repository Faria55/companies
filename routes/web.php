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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');

Route::resource('admin/companies', 'CompaniesController');

Route::resource('admin/employees', 'EmployeesController');

//routes for unregistered
Route::get('/companies', 'CompaniesController@index');
Route::get('/companies/{id}', 'CompaniesController@show');

Route::get('/employees', 'EmployeesController@index');
Route::get('/employees/{id}', 'EmployeesController@show');
