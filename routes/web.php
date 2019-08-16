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

Route::get('register', 'Auth\RegisterController@chooseUserType')->name('register');
Route::get('register/member', 'Auth\RegisterController@createMember')->name('register.member.create');
Route::post('register/member', 'Auth\RegisterController@storeMember')->name('register.member.store');
Route::get('register/volunteer', 'Auth\RegisterController@createVolunteer')->name('register.volunteer.create');
Route::post('register/volunteer', 'Auth\RegisterController@storeVolunteer')->name('register.volunteer.store');

Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', 'ProfileController@index')->name('profile');

Route::get('membership', 'MembershipController@index')->name('membership');
Route::get('membership/renew', 'MembershipController@renew');

Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/volunteer/{id}/approve', 'AdminController@approveVolunteer')->where('id', '[0-9]+');
Route::get('admin/volunteer/{id}/reject', 'AdminController@rejectVolunteer')->where('id', '[0-9]+');
Route::get('admin/application_files/{id}.pdf', 'AdminController@downloadVolunteerApplication')->where('id', '^[a-zA-Z0-9_]*$');

Route::get('services-requests', 'ServiceRequestController@index')->name('service_requests.index');
Route::post('services-requests', 'ServiceRequestController@store')->name('service_requests.store');
Route::get('services-requests/{service_request}/cancel', 'ServiceRequestController@cancel')->where('service_request', '[0-9]+')->name('service_requests.cancel');
Route::get('services-requests/{service_request}/pickup', 'ServiceRequestController@pickUp')->where('service_request', '[0-9]+')->name('service_requests.pick_up');

Route::get('planning/export', 'ExportController@planning')->name('planning.export');
