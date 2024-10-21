<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen w-screen bg-gradient-to-br from-Maroon via-Blue/70 from-10% to-90% to-Mauve">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
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
<body class="flex flex-row font-sans antialiased text-Text h-full p-2 gap-2">
<div class="flex flex-col bg-Surface_1/70 w-fit h-full p-2 rounded-md shadow-2xl shadow-black border-Crust border-2 group/a hover:border-Mauve backdrop-blur-2xl">
    <a href="{{route('home')}}">
        <div class="flex flex-shrink h-min rounded-md p-2 w-fit text-3xl text-Rosewater  font-extrabold bg-gradient-to-br from-Maroon via-Blue/70 from-10% to-90% to-Mauve m-2 px-6 mx-auto border-Crust border-[1px] select-none">
            Nynxz
        </div>
    </a>
    <hr class="group-hover/a:border-Mauve border-Surface_2 mx-2 border-2 rounded-full group-hover/a:animate-pulse"/>
    <div class="overflow-y-scroll flex flex-col my-2">
        @foreach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ,19 ,20, 21, 22,23] as $post)
            <a href="{{route('post', $post)}}">Post {{$post}}</a>
            <a href="{{route('post', $post)}}">Post {{$post}}</a>
            <a href="{{route('post', $post)}}">Post {{$post}}</a>
        @endforeach
    </div>
</div>
<div class="w-full h-full">
    {{$slot}}
</div>
</body>
</html>
