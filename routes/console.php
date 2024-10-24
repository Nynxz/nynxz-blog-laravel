<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PostController;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('sync', function () {
    $this->comment("Syncing Posts");

    $posts = PostController::SyncPosts();

    $count = array_sum(array_map("count", $posts));
    $this->info(count($posts).' Groups Synced');
    $this->info($count.' Posts Synced');

})->purpose('Sync blog posts to Cache & DB')->daily();
