<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Storage;
use Str;

class PostController extends Controller
{
    public function index($id): View|RedirectResponse
    {
        $post = Cache::rememberForever('post_' . $id, function () use ($id) {
            return Post::where('slug', $id)->first();
        });

        return $post
            ? view('post')->with('post', $post)
            : redirect()->route('home');
    }

    private static function DeleteAllPosts(): void
    {

        $db = Post::all();
        foreach($db as $p){
            $p->delete();
        }
    }
    public static function SyncPosts(): array
    {
        PostController::DeleteAllPosts();

        $posts = array();
        $topics = Storage::disk('blog-posts')->allDirectories();

        foreach ($topics as $topic) {
            $topic_posts = array();
            foreach (Storage::disk('blog-posts')->allFiles($topic) as $post) {
                $f = Storage::disk('blog-posts')->path($post);
                $f = file($f);
                $topic_posts[] = Post::create([
                    'title' => rtrim($f[0]),
                    'date' => rtrim($f[1]),
                    'topic' => $topic,
                    'slug' => Str::slug($topic.'-'.rtrim($f[0])),
                    'content' => implode((array)array_slice($f, 2))
                ])->toArray();
            }
            $posts[$topic] = [
                'title' => $topic,
                'posts' => $topic_posts,
            ];


        }

        Cache::flush();

        return $posts;
    }
}
