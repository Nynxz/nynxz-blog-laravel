<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return view('home')->with(['warning'=> $request->query('warning')]);
})->name('home');

Route::get('/post/{id}', function (Request $request, $id) {

    $post = Cache::rememberForever('post_' . $id, function () use ($id) {
        return Post::where('slug', $id)->first();
    });

    return $post
        ? view('post')->with('post', $post)
        : redirect()->route('home');

})->name('post')->middleware('throttle:11110,1');

Route::fallback(function () {
    return redirect()->route('home');
});


Route::get('/confirmation', function (Request $request) {
    return redirect()->route('home', ['warning' =>  $request->get('warning', '/')]);
});
