<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'slug',
        'content',
    ];

    public static function RecentPosts() {
        return Cache::remember('all_posts', now()->addHour(), function() {
            return Post::all()->toArray();
        });
    }
}
