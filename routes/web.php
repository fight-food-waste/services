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

Route::get('lang/{locale}', 'LocalizationController@setLocale')->name('lang.switch');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('account', 'AccountController@index')->name('account.index');
Route::get('account/edit', 'AccountController@edit')->name('account.edit');
Route::delete('account', 'AccountController@destroy')->name('account.destroy');
Route::put('account', 'AccountController@update')->name('account.update');

Route::get('register', 'Auth\RegisterController@chooseUserType')->name('register');
Route::get('register/member', 'Auth\RegisterController@createMember')->name('register.member.create');
Route::post('register/member', 'Auth\RegisterController@storeMember')->name('register.member.store');
Route::get('register/volunteer', 'Auth\RegisterController@createVolunteer')->name('register.volunteer.create');
Route::post('register/volunteer', 'Auth\RegisterController@storeVolunteer')->name('register.volunteer.store');

Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', 'ProfileController@index')->name('profile');

Route::get('membership', 'MembershipController@index')->name('membership');
Route::get('membership/renew', 'MembershipController@renew')->name('membership.renew');

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');

    Route::get('volunteers', 'Admin\VolunteerController@index')->name('admin.volunteers.index');
    Route::post('volunteers/{volunteer}/approve', 'Admin\VolunteerController@approveVolunteer')->where('volunteer', '[0-9]+')->name('admin.volunteers.approve');
    Route::post('volunteers/{volunteer}/reject', 'Admin\VolunteerController@rejectVolunteer')->where('volunteer', '[0-9]+')->name('admin.volunteers.reject');
    Route::get('volunteers/application_files/{id}', 'Admin\VolunteerController@downloadApplication')->name('admin.volunteers.application_file.download');

    Route::get('members', 'Admin\MemberController@index')->name('admin.members.index');

    Route::get('services', 'Admin\ServiceController@index')->name('admin.services.index');
    Route::post('services', 'Admin\ServiceController@store')->name('admin.services.store');

    Route::get('service-requests', 'Admin\ServiceRequestController@index')->name('admin.service_requests.index');
    Route::get('service-requests/{service_request}/cancel', 'Admin\ServiceRequestController@cancel')->where('service_request', '[0-9]+')->name('admin.service_requests.cancel');
});

Route::get('services-requests', 'ServiceRequestController@index')->name('service_requests.index');
Route::post('services-requests', 'ServiceRequestController@store')->name('service_requests.store');
Route::get('services-requests/{service_request}/cancel', 'ServiceRequestController@cancel')->where('service_request', '[0-9]+')->name('service_requests.cancel');
Route::get('services-requests/{service_request}/pickup', 'ServiceRequestController@pickUp')->where('service_request', '[0-9]+')->name('service_requests.pick_up');

Route::get('time-slots', 'TimeSlotController@index')->name('time_slots.index');
Route::post('time-slots', 'TimeSlotController@store')->name('time_slots.store');
Route::delete('time-slots/{timeSlot}', 'TimeSlotController@destroy')->name('time_slots.destroy');

Route::get('planning', 'PlanningController@index')->name('planning.index');
Route::get('planning/export', 'PlanningController@export')->name('planning.export');
