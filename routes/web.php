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

use Illuminate\Support\Facades\Route;

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::view('/', 'start');

//korte route voor statisch
Route::get('book', 'ReservationController@index');
Route::resource('overview', 'Admin\OverviewController');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('reservations', 'Admin\OverviewController');
    Route::resource('reservation', 'Admin\ReservationController');
    Route::resource('room', 'Admin\RoomController');
    Route::resource('arrangement', 'Admin\ArrangementController');
    Route::resource('bill', 'Admin\BillController');





});
Route::view('/', 'start');
Route::redirect('user', '/user/profile');
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
});

