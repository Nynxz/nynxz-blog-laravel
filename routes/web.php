<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/post/{id}', function (Request $request, $id) {
    $post = Cache::rememberForever('post_' . $id, function () use ($id) {
        return Post::where('slug', $id)->firstOrFail()->toArray();
    });
    return view('post')->with('post', $post);
})->name('post')->middleware('throttle:11110,1');

Route::fallback(function () {
    return redirect('/');
});
