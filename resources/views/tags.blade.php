@php use App\Models\Post;use Illuminate\Support\Carbon; @endphp
<x-layout>
    <div
        class="relative flex flex-col p-2 bg-Surface_2/50 border-Crust border-2 rounded-md w-full h-full shadow-black shadow-2xl group/main hover:border-Mauve backdrop-blur-2xl transition-all duration-500">
        <div class="relative w-full rounded-md md:p-2 p-1 -z-10 flex md:flex-col flex-col md:gap-2 gap-1 h-full">
            <div class="grid grid-flow-col md:gap-2 gap-1 rounded-md w-full h-fit md:text-normal text-xs">
                <a href="{{route('home')}}"
                    class="bg-Surface_0/75 hover:border-Mauve hover:cursor-pointer md:p-2 p-1 h-fit rounded-md border-2 border-Crust flex flex-row transition-all">
                    <x-icons.www class="md:w-8 md:h-8 w-6 h-6"/>
                    <span class="my-auto px-2 font-bold">
                        Posts
                    </span>
                </a>
                <a href="{{route('tags')}}"
                    class="bg-Surface_0/75 hover:border-Mauve hover:cursor-pointer md:p-2 p-1 h-fit rounded-md border-2 border-Crust flex flex-row transition-all">
                    <x-icons.www class="md:w-8 md:h-8 w-6 h-6"/>
                    <span class="my-auto px-2 font-bold">
                        Tags
                    </span>
                </a>
                <div
                    class="bg-Surface_0/75 hover:border-Mauve hover:cursor-pointer md:p-2 p-1 h-fit rounded-md border-2 border-Crust flex flex-row transition-all">
                    <x-icons.www class="md:w-8 md:h-8 w-6 h-6"/>
                    <span class="my-auto px-2 font-bold">
                        Bookmarks
                    </span>
                </div>
            </div>
            <div class="grid grid-flow-col gap-2 rounded-md w-full  bg-Surface_0/75 border-2 border-Crust h-full">
                <ul class="md:p-2 p-1 md:m-2 m-1 md:gap-2 gap-1 flex flex-col transition-all duration-500">
                    @foreach($tags as $tag)
                        <li class="bg-Surface_0  relative border-Crust border-[1px] rounded-md w-full flex group/post hover:shadow-black/30  hover:shadow-lg transition-all duration-500">
                            <a class=" absolute w-full h-full rounded-md" href="{{route('tag', strtolower($tag->name))}}"></a>
                            <div href="{{route('tag', $tag->name)}}" class="font-extrabold  w-full p-2 rounded-md z-[1] pointer-events-none">
                                {{$tag->name}}
                                <hr class=" rounded-md my-1 group-hover/post:border-Pink border-[1px] border-Surface_2 transition-colors duration-500"/>
                            <span class="font-semibold">
                                {{$tag->posts_count}} Posts
                            </span>
                            <span class="text-xs font-medium">
                            </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layout>
