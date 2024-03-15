{{-- <x-layout>
    <x-slot name="content">
        @foreach($blogs as $blog)

        <div class="{{$loop->odd ? 'bg-yellow' : ''}}">
            <h1><a href="blog/{{$blog->slug}}">{{$blog->title}}</a></h1>
    
            <div>
                <p>Published at {{$blog->date}}</p>
                <p>{{$blog->intro}}</p>
            </div>
        </div>
    
        @endforeach
    </x-slot>
</x-layout> --}}

{{-- <x-layout content="Hello World"></x-layout> --}}

{{-- <x-layout>
    <x-slot name="title">
        All Blog
    </x-slot>
    @foreach($blogs as $blog)

        <div class="{{$loop->odd ? 'bg-yellow' : ''}}">
            <h1><a href="blog/{{$blog->slug}}">{{$blog->title}}</a></h1>
            <h3>Author - <a href="users/{{$blog->author->username}}">{{$blog->author->name}}</a></h3>
            <p><a href="categories/{{$blog->category->slug}}">{{$blog->category->name}}</a></p>
    
            <div>
                <p>Published at {{$blog->created_at->diffForHumans()}}</p>

                <p>{{$blog->intro}}</p>
                <p>{{$blog->body}}</p>
            </div>
        </div>
    
        @endforeach
</x-layout> --}}
<x-layout>
    <x-slot name="title">All Blogs</x-slot>
    {{-- @if (session()->get('success')) --}}
    @if (session('success'))
        <div class="alert-success text-center py-5">{{session('success')}}</div>  
    @endif
    <x-hero></x-hero>

    <x-blogsection :blogs="$blogs"/>

</x-layout>