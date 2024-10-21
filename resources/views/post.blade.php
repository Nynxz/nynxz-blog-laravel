<x-layout>

    <div  class=" flex flex-col p-2 bg-Surface_2/70 border-Crust border-2 rounded-md w-full h-full shadow-black shadow-2xl group/main hover:border-Mauve backdrop-blur-2xl">
        <span class="font-bold text-3xl">{{$id}}</span>
        <div class="markdown-body overflow-y-scroll overflow-x-auto border-Crust border-2 rounded-md  bg-Base px-14 py-2 ">
        {!!  Str::markdown("
## hi!

# Very Nice!
This is a blog post :)

```
console.log('Hello World')
```

![alt text](/img.ico 'Title')

**Wow**

*Yes*

> Working??

1. Maybe
2. So

- one
- two

---

[title](https://www.example.com)
| Syntax | Description |
| ----------- | ----------- |
| Header | Title |
| Paragraph | Text |

~~The world is flat.~~

That is so funny! :joy:

- [x] Write the press release
- [ ] Update the website
- [ ] Contact the media

Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
Long TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong TextLong Text
")!!}

        </div>
    </div>
</x-layout>
