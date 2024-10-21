<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/post/{id}', function (Request $request, $id) {
    return view('post')->with('id', $id);
})->name('post')->middleware('throttle:11110,1');

