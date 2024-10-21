<?php

use App\Models\Post;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('sync', function () {
    $this->comment("Syncing Posts");

    $posts = Storage::disk('local')->allFiles();
    $db = Post::all();
    foreach($db as $p){
        $p->delete();
    }
    echo implode($posts);
    foreach ($posts as $post) {
        Post::create([
            'title' => $post,
            'slug' => Str::slug($post),
            'content' => Storage::disk('local')->get($post),
        ]);
    }
    Cache::forget('all_posts');
    Cache::flush();

})->purpose('Display an inspiring quote')->hourly();
