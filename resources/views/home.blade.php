<x-layout>
    <div class="relative flex flex-col p-2 bg-Surface_2/50 border-Crust border-2 rounded-md w-full h-full shadow-black shadow-2xl group/main hover:border-Mauve backdrop-blur-2xl">
        @if($warning)
        <div class="absolute left-0 top-0 flex flex-grow w-full h-full items-center justify-center pointer-events-none">
            <div href="/" class="pointer-events-auto p-4 text-center flex justify-center items-center w-1/3 bg-Surface_2  flex-col h-fit rounded-md">
            <span class="text-center w-full rounded-md text-3xl text-Red">
                WARNING
                </span>
                <span class="text-3xl">NSFW Content Ahead!</span>
                <span class="text-3xl">(Adult Content, XXXX, Nudity)</span>
                <span class="flex flex-row gap-4 text-xl font-bold my-8">
                    <a href="/" class="pointer-events-auto hover:underline hover:text-Red">
                        Back
                    </a>
                    <a href="https://{{$warning}}" class="pointer-events-auto hover:underline hover:text-Green">
                        Continue
                    </a>
                </span>
            </div>
        </div>
        @endif
        <div class="text-4xl font-bold mx-auto">Hello!</div>
        <div class="relative w-full rounded-md h-1/2 p-2 -z-10">


{{--            @if($confirmation)--}}

{{--            @endif--}}


            <div class="bg-Surface_0 p-2 w-fit rounded-md m-2 group/a">
                <div class="relative mx-auto my-2 w-32 h-32 border-Crust border-2 rounded-full ">
                    <img src="{{asset('mee.png')}}" alt="icloud me max-w-8 max-h-8"/>
                    <div class="absolute left-0 top-0 w-full h-full inset-0 rounded-full group-hover/a:ring-Mauve group-hover/a:ring-2 animate-pulse"></div>
                </div>
                <span class="font-bold underline text-2xl m-2">
                    Contact Me
                </span>
                <ul class="flex flex-col gap-2 m-2">
                    <li class="flex flex-row group cursor-pointer"> <x-icons.email class="w-8 h-8 "/>
                        <span class="my-auto px-2 text-lg font-bold"> Email </span>
                    </li>
                    <li class="flex flex-row group cursor-pointer"> <x-icons.github class="w-8 h-8 "/>
                        <span class="my-auto px-2 text-lg font-bold">Github</span>
                    </li>
                    <li class="flex flex-row group cursor-pointer"> <x-icons.linkedin class="w-8 h-8 "/>
                        <span class="my-auto px-2 text-lg font-bold"> LinkedIn</span>
                    </li>
                    <li class="flex flex-row group cursor-pointer"> <x-icons.discord class="w-8 h-8 "/>
                        <span class="my-auto px-2 text-lg font-bold"> Discord </span>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="bg-Surface_0 p-2 w-fit rounded-md m-2">
                <span class="font-bold underline text-2xl m-2">
                    Sites
                </span>
                <ul class="flex flex-col gap-2 m-2">
                    @foreach(['ssh.ninja', 'expire.tech', 'pinks.world'] as $site)
                    <li>

                        @if($site == 'pinks.world')
                            <form action="/confirmation" method="get" class="flex flex-row group cursor-pointer">
                                <input type="text" name="warning" hidden value="{{$site}}">
                                <button type="submit" class="flex flex-row group cursor-pointer">
                                    <x-icons.www class="w-8 h-8 "/>
                                    <span class="my-auto px-2 text-lg font-bold">{{$site}}</span>
                                </button>

                            </form>
                        @else
                            <a href="https://{{$site}}" class="flex flex-row group cursor-pointer">
                                <x-icons.www class="w-8 h-8 "/>
                                <span class="my-auto px-2 text-lg font-bold">{{$site}}</span>
                            </a>
                        @endif


                    </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
</x-layout>
