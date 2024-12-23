@php use Carbon\Carbon; @endphp
@section('title')
    {{config('blog.s_title').$post['title']}}
@endsection
<x-layout>
    <div  class="flex flex-row p-2 bg-Surface_2/50 items-center border-Crust border-2 rounded-md w-full h-full shadow-black shadow-2xl group/main hover:border-Mauve backdrop-blur-2xl transition-all">
        <div class="flex-grow  flex-col overflow-y-auto mx-auto overflow-x-auto border-Crust border-2 rounded-md  bg-Base px-[3%] py-2 h-full ">
        <span class="w-full flex-grow font-bold text-3xl underline text-Pink mb-2 justify-between flex flex-row">
            <span>
            {{$post['title']}}
            </span>
        </span>
        <hr class="border-Mauve my-2">
            <div class="max-h-0">
                @foreach($post->tags as $tag)
                    <a href="/tag/{{ strtolower($tag->name) }}" class="pointer-events-auto bg-Surface_1 text-xs rounded-md px-2 h-fit hover:bg-Pink hover:text-Base transition-colors duration-200">{{ $tag->name }}</a>
                @endforeach
                <span>
                    {{Carbon::create($post['date'])->diffForHumans()}} |
                    {{$post['date']}}
                </span>
                <!--email_off-->
                {!!  Str::markdown($post['content'])!!}
                <!--/email_off-->
            </div>
        </div>
    </div>
</x-layout>
