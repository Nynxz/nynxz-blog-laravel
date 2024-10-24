<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', [PostController::class, 'index'])->name('post')->middleware('throttle:30,1');

Route::fallback([HomeController::class, 'redirectToIndex']);

Route::get('/confirmation', function (Request $request) {
    return redirect()->route('home', ['warning' =>  $request->get('warning', '/')]);
});
