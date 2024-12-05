@php use App\Http\Controllers\PostController;use App\Models\Post; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="bg-blue-500 max-h-screen h-full bg-gradient-to-br from-Maroon via-Blue/70 from-10% to-90% to-Mauve">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('blog.s_title')."Home")</title>
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
<body class="flex flex-col font-sans antialiased text-Text h-full md:p-2 p-1 md:gap-2 gap-1 transition-all duration-700">
<div
    class="bg-Surface_1/50 w-full p-1 rounded-md shadow-2xl shadow-black  text-Rosewater border-Crust border-2 group/a hover:border-Mauve backdrop-blur-2xl font-bold text-2xl transition-all">
    @if(Route::currentRouteName() == 'home')
        <span class="select-none ">
            {{config('blog.title')}}
        </span>
    @else
        <a href="/" class="select-none hover:underline">
            {{config('blog.title')}}
        </a>
    @endif
</div>
<div class="flex flex-row gap-2 h-full">
    <div class="flex flex-grow w-full">
        {{$slot}}
    </div>
    <div
        class="max-w-64 w-[15%] min-w-48 md:flex md:flex-col md:gap-2 bg-Surface_1/50 h-full p-2 rounded-md shadow-2xl   hidden shadow-black border-Crust border-2 group/a hover:border-Mauve backdrop-blur-2xl transition-all">
        {{--        ABOUT ME --}}
        <div class="bg-Surface_0 p-2 rounded-md group/a text-center select-none">
            <div class="relative mx-auto mt-2 w-24 h-24 border-Crust border-2 rounded-full select-none">
                <img src="{{asset('mee.png')}}" alt="icloud me " class=""/>
                <div
                    class="absolute left-0 top-0 w-full h-full inset-0 rounded-full opacity-0 group-hover/a:opacity-100 transition-all group-hover/a:ring-Rosewater  group-hover/a:ring-2 animate-pulse"></div>
            </div>
            <div class="font-semibold text-center text-sm m-2 select-none">
                <span class="font-bold underline select-text">
                    {{config('blog.author')}}
                </span>
                <br>
                Security Engineer @
                <br>
                <div class=" hover:text-[#55C1E2] text-center w-fit mx-auto">
                    <a href="https://secdim.com" class="flex flex-row gap-1 text-center mx-auto w-fit" target="_">
                        <img src="{{asset('secdimlogo.png')}}" width="16" height="16" alt="my-auto secdim logo"
                             class="w-4 h-4 my-auto"/>
                        SecDim
                    </a>
                </div>
            </div>
            <ul class="flex flex-row gap-2 m-2">
                <li class="flex flex-row group cursor-pointer">
                    <a href="mailto:contact@nynxz.com" class="flex flex-row" title="Email">
                        <x-icons.email class="w-6 h-6 "/>
                        {{--                        <span class="my-auto pl-2 text-base font-bold"  > Email </span>--}}
                    </a>
                </li>
                <li class="flex flex-row group cursor-pointer">
                    <a href="https://github.com/nynxz" class="flex flex-row" target="_" title="Github">
                        <x-icons.github class="w-6 h-6 "/>
                        {{--                        <span class="my-auto pl-2 text-base font-bold">Github</span>--}}
                    </a>
                </li>
                <li class="flex flex-row group cursor-pointer">
                    <a href="https://www.linkedin.com/in/henry-lee-3042b27a/" class="flex flex-row" target="_"
                       title="LinkedIn">
                        <x-icons.linkedin class="w-6 h-6 "/>
                        {{--                        <span class="my-auto pl-2 text-base font-bold"> LinkedIn</span>--}}
                    </a>
                </li>
            </ul>
        </div>
        {{--        <a href="{{route('home')}}">--}}
        {{--            <div--}}
        {{--                class="flex flex-shrink h-min rounded-md p-2 w-fit text-3xl text-Rosewater  font-extrabold bg-gradient-to-br from-Maroon via-Blue/70 from-10% to-90% to-Mauve m-2 px-6 mx-auto border-Crust border-[1px] select-none">--}}
        {{--                Nynxz--}}
        {{--            </div>--}}
        {{--        </a>--}}
        <hr class="group-hover/a:border-Mauve border-Surface_2 mx-2  border-2 rounded-full group-hover/a:animate-pulse"/>
        <div class="overflow-y-hidden flex flex-col">
            <ul class=" rounded-md p-2 bg-Base/50 ">
                <?php $posts = Post::RecentPosts() ?>
                @while($topic = current($posts))
                    <li class="flex">
                        <div class="group/topic hover:grow transition-all ">
                            <span class=" select-none text-xl font-extrabold">
                                {{key($posts)}}
                            </span>
                            <hr class="border-Mauve border-[1px]">
                            <div class="opacity-0 group-hover/topic:opacity-100 group-hover/topic:flex grow transition-all duration-500">
                                <ul class="pl-1 text-sm text-Text">
                                    @foreach($topic as $post)
                                        <li class="hover:text-Mauve hover:underline hidden group-hover/topic:flex transition-all">
                                            <a href="{{route('post', $post['slug'])}}">{{$post['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                        <?php next($posts) ?>
                @endwhile
            </ul>
        </div>
    </div>
</div>

</body>
</html>
