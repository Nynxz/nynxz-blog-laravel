<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('sync', function () {
    $this->comment("Syncing Posts");

    $posts = PostController::SyncPosts();

    $count = array_sum(array_map("count", $posts));
    $this->info(count($posts).' Groups Synced');
    $this->info($count.' Posts Synced');

})->purpose('Display an inspiring quote')->hourly();
