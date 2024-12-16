<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        return view('home')->with([
            'posts' => Cache::rememberForever('posts', function () {
                return Post::with('tags')->orderBy('date', 'desc')->get();
            }),
            'warning'=> $request->query('warning')
        ]);
    }

    public function tag(string $tag) {
        return Cache::rememberForever('tag'.$tag, function() use ($tag) {
            $tag = Tag::where('name', $tag)->firstOrFail();
            return view('home')->with([
                'posts' => $tag->posts->sortByDesc('date')
            ])->render();
        });
    }

    public function tags() {
        return view('tags')->with([
            'tags' => Cache::rememberForever('tags', function() {
                return Tag::all()->loadCount('posts');
            })
        ]);
    }

    public function redirectToIndex(): RedirectResponse
    {
        return redirect()->route('home');
    }

}
