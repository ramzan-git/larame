<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
/*
Route::get('/contact', function () {
    return view('contacts.index');;
});


Route::get('/create', function () {
    return view('contacts.create');
});

Route::resource('contacts', 'ContactController::class');
Route::get('/contact', ['ContactController::class', 'index'])

//Comment
Route::get('/create', ['ContactController::class', 'index'])

*/
Route::resource('contacts', ContactController::class);