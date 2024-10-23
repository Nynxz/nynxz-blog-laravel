<x-layout>
    <div class="flex flex-col p-2 bg-Surface_2/50 border-Crust border-2 rounded-md w-full h-full shadow-black shadow-2xl group/main hover:border-Mauve backdrop-blur-2xl">
        <div class="text-4xl font-bold mx-auto">Hello!</div>
        <div class="w-full rounded-md h-1/2 p-2">



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
                    <li >
                        <a href="https://{{$site}}" class="flex flex-row group cursor-pointer">
                            <x-icons.www class="w-8 h-8 "/>
                            <span class="my-auto px-2 text-lg font-bold">{{$site}}</span>
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
</x-layout>
