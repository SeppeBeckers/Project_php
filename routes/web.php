
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

Route::get('reservation/book', 'ReservationController@index');
Route::get('reservation/data', 'ReservationController@create');
Route::get('reservation/summary', 'ReservationController@store');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    route::redirect('/', 'overview');
    //Route::get('overview', 'Admin\OverviewController@index');
    Route::resource('reservation', 'Admin\ReservationController');
    Route::resource('overview', 'Admin\OverviewController');
    Route::resource('room', 'Admin\RoomController');
    Route::resource('room/{id}/not_available', 'Admin\AvailableController');
    Route::delete('room/{id}/not_available', 'Admin\AvailableController@destroy');
    Route::resource('arrangement', 'Admin\ArrangementController');
    Route::resource('bill', 'Admin\BillController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
