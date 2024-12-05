<?php

use App\Models\Post;
use Carbon\Carbon;
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
    $this->info(count($posts) . ' Groups Synced');
    $this->info($count . ' Posts Synced');

})->purpose('Sync blog posts to Cache & DB')->daily();


Artisan::command('debug', function () {
    $topics = Storage::disk('blog-posts')->allDirectories();
    $posts = 0;
    foreach ($topics as $topic) {
        $this->error("# " . $topic);
        foreach (Storage::disk('blog-posts')->allFiles($topic) as $post) {
            $f = Storage::disk('blog-posts')->path($post);
            $yaml = PostController::frontmatter_extract($f);
            if ($yaml != 1) {
                $this->comment('- '.$yaml['title']);
                $this->info(\Illuminate\Support\Carbon::createFromTimestamp($yaml['date']));
                $this->info(implode(' ', $yaml['tags']));
            }
            $posts++;
        }
    }
    $this->info("---");
    $this->info(count($topics) . ' Groups & ' . $posts . ' Posts Synced');
})->purpose('Inspect Post Metadata')->daily();
