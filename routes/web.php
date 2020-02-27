<?php


Route::view('/', 'start');
gitRoute::get('start', function () {
    return view('start');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');





