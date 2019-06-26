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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('register', 'Auth\RegisterController@register');
Route::get('register', 'Auth\RegisterController@showRegistrationDispatcher')->name('register');
Route::get('register/member', 'Auth\RegisterController@showRegistrationForm')->defaults('userType', 'member');
Route::post('register/member', 'Auth\RegisterController@storeMember');
Route::get('register/volunteer', 'Auth\RegisterController@showRegistrationForm')->defaults('userType', 'volunteer');
Route::post('register/volunteer', 'Auth\RegisterController@storeVolunteer');

Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', 'ProfileController@index')->name('profile');

Route::get('membership', 'MembershipController@index')->name('membership');
Route::get('membership/renew', 'MembershipController@renew');

Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/volunteer/{id}/approve', 'AdminController@approveVolunteer')->where('id', '[0-9]+');
Route::get('admin/volunteer/{id}/reject', 'AdminController@rejectVolunteer')->where('id', '[0-9]+');
Route::get('admin/application_files/{id}.pdf', 'AdminController@downloadVolunteerApplication')->where('id', '^[a-zA-Z0-9_]*$');

Route::get('services', 'ServiceRequestController@index')->name('services');
Route::post('services/new/prepare', 'ServiceRequestController@prepareNew');
Route::post('services/new/confirm', 'ServiceRequestController@confirmNew');

Route::get('planning/export', 'ExportController@planning')->name('planning.export');
