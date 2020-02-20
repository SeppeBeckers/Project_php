<?php



Route::view('/', 'start');
Route::get('start', function () {
    return view('start');
});
