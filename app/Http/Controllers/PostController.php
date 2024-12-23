<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Cache;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Storage;
use Str;
use Symfony\Component\Yaml\Yaml;

class PostController extends Controller
{
    public function index($id): View|RedirectResponse
    {
        $post = Cache::rememberForever('post_' . $id, function () use ($id) {
            return Post::with('tags')->where('slug', $id)->first();
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

    private static function DeleteAllTags(): void
    {
        $db = Tag::all();
        foreach($db as $t){
            $t->delete();
        }
    }
    public static function SyncPosts(): array
    {
        PostController::DeleteAllPosts();
        PostController::DeleteAllTags();

        $posts = array();
        $topics = Storage::disk('blog-posts')->allDirectories();

        foreach ($topics as $topic) {
            $topic_posts = array();
            foreach (Storage::disk('blog-posts')->allFiles($topic) as $post) {
                $filePath = Storage::disk('blog-posts')->path($post);
                $yaml = PostController::frontmatter_extract($filePath);
                $f = file($filePath);

                $post =  Post::create([
                    'title' => $yaml['title'],
                    'date' => Carbon::createFromTimestamp($yaml['date']),
                    'topic' => $topic,
                    'slug' => Str::slug(hash('sha1', $topic.'-'.$yaml['title'].'-'.$filePath)),
                    'content' => implode(PostController::file_remove_frontmatter($f)) //Remove all the YAML!
                ]);
                $topic_posts[] = $post->toArray();

                foreach ($yaml['tags'] as $tag) {
                    $t = Tag::firstOrCreate(['name' => $tag]);
                    $post->tags()->save($t);
                }
            }
            $posts[$topic] = [
                'title' => $topic,
                'posts' => $topic_posts,
            ];


        }

        Cache::flush();

        return $posts;
    }


    public static function frontmatter_extract(string $filePath){
        $content = file_get_contents($filePath);
        try{
            if(!$content) throw new Exception("Failed to read the file at ");
            if(preg_match('/^---\n(.*?)\n---\n/s', $content, $matches)){
                $yamlString = $matches[1];
                return Yaml::parse($yamlString);
            }
        } catch(Exception $e){
            dd($e);
        }
    }

    private static function file_remove_frontmatter(array $file){
        $cleaned = [];
        $inFrontMatter = false;

        foreach($file as $line){
            if ($line === "---\n" || $line === "---\r\n") {
                $inFrontMatter = !$inFrontMatter;
                continue;
            }

            if(!$inFrontMatter){
                $cleaned[] = $line;
            }
        }
        return $cleaned;
    }
}
