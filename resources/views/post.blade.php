<x-layout>

    <div  class=" flex flex-row p-2 bg-Surface_2/50 items-center border-Crust border-2 rounded-md w-full h-full shadow-black shadow-2xl group/main hover:border-Mauve backdrop-blur-2xl">
        <div class="flex-grow  flex-col overflow-y-auto mx-auto overflow-x-auto border-Crust border-2 rounded-md  bg-Base px-14 py-2 h-full ">
        <span class="font-bold text-3xl underline text-Pink mb-2 justify-between flex flex-row">
            <span>
            {{$post['title']}}
            </span>
            <span>
            {{date('d-m-Y', strtotime($post['created_at']))}}
            </span>
        </span>
        <hr class="border-Mauve my-2">
            <div class="markdown-body">
                <!--email_off-->
                {!!  Str::markdown($post['content'])!!}
                <!--/email_off-->
            </div>
        </div>
    </div>
</x-layout>
