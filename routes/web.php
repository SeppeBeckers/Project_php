<?php



Route::view('/', 'start');
Route::get('start', function () {
    return view('start');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::view('/', 'home');