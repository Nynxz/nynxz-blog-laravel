<?php

namespace App\Models;

use App\Http\Controllers\PostController;
use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function now;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'date',
        'topic',
        'slug',
        'content',
    ];

    public static function RecentPosts() {
        return Cache::rememberForever('post_links', function() {
            $posts = Post::all(['title', 'topic', 'slug'])->toArray();
            return Post::_group_by($posts, 'topic');
        });
    }

    private static function _group_by($array, $key): array
    {
        $return = array();
        foreach($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }
}
