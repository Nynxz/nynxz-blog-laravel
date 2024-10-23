@php use App\Models\Post; @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen w-screen bg-gradient-to-br from-Maroon via-Blue/70 from-10% to-90% to-Mauve">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nynxz</title>
    <!-- Fonts -->
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite([
    'resources/css/app.css',
//    'resources/js/app.js'
    ])
    @endif
</head>
<body class="flex flex-col sm:flex-row font-sans antialiased text-Text h-full p-2 gap-2">
<div class="flex flex-col bg-Surface_1/50 w-fit h-fit sm:h-full p-2 rounded-md shadow-2xl shadow-black border-Crust border-2 group/a hover:border-Mauve backdrop-blur-2xl">
    <a href="{{route('home')}}">
        <div class="flex flex-shrink h-min rounded-md p-2 w-fit text-3xl text-Rosewater  font-extrabold bg-gradient-to-br from-Maroon via-Blue/70 from-10% to-90% to-Mauve m-2 px-6 mx-auto border-Crust border-[1px] select-none">
            Nynxz
        </div>
    </a>
    <hr class="group-hover/a:border-Mauve border-Surface_2 mx-2 border-2 rounded-full group-hover/a:animate-pulse"/>
    <div class="overflow-y-auto flex flex-col my-2 h-full">
        @foreach(Post::RecentPosts() as $post)
            <a href="{{route('post', $post['slug'])}}">{{$post['title']}}</a>
        @endforeach
    </div>
</div>
<div class="w-full h-full">
    {{$slot}}
</div>
</body>
</html>
