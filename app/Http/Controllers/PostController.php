<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Cache;
use Illuminate\Http\Request;
use Storage;
use Str;
use function array_slice;
use function implode;
use function redirect;
use function rtrim;
use function view;

class PostController extends Controller
{
    public function index(Request $request, $id) {
        $post = Cache::rememberForever('post_' . $id, function () use ($id) {
            return Post::where('slug', $id)->first();
        });

        return $post
            ? view('post')->with('post', $post)
            : redirect()->route('home');
    }

    private static function DeleteAllPosts(){

        $db = Post::all();
        foreach($db as $p){
            $p->delete();
        }
    }
    public static function SyncPosts()
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
                    'content' => implode(array_slice($f, 2))
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
