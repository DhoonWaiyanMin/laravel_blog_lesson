{{-- <x-layout>
    <x-slot name="title">{{$blog->title}}</x-slot>
    <h1>{{$blog->title}}</h1>
    <p>{{$blog->slug}}</p>
    <p>{{$blog->body}}</p>
    <a href="/">Back</a>
</x-layout> --}}
<x-layout>
  <x-slot name="title">{{$blog->title}}</x-slot>

  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto text-center">
        <img
          src="https://creativecoder.s3.ap-southeast-1.amazonaws.com/blogs/GOLwpsybfhxH0DW8O6tRvpm4jCR6MZvDtGOFgjq0.jpg"
          class="card-img-top"
          alt="..."
        />
        <h3 class="my-3">{{$blog->title}}</h3>
        <div>Author - <a href="users/{{$blog->author->username}}">{{$blog->author->name}}</a></div>
        <div class="badge bg-primary"><a href="/categories/{{$blog->category->slug}}" class="text-white text-decoration-none">{{$blog->category->name}}</a></div>
        <div class="text-secondary">{{$blog->created_at->diffForHumans()}}</div>
        <div>
          <form action="/blogs/{{$blog->slug}}/subscription" method="POST">
            @csrf 
            {{-- @if(auth()->user()->subscribedBlogs && auth()->user()->subscribedBlogs()->contains('id',$blog->id))
              <button class="btn btn-danger">Unsubscribe</button>
            @else
              <button class="btn btn-warning">Subscribe</button>
            @endif --}}

            @auth
              @if(auth()->user()->isSubscribed($blog))
                <button type="submit" class="btn btn-danger">Unsubscribe</button>
              @else
                <button type="submit" class="btn btn-warning">Subscribe</button>
              @endif
            @endauth
          </form>
        </div>
        <p class="lh-md mt-3">
          {{$blog->body}}
        </p>
      </div>
    </div>
  </div>

  <x-comments :comments="$blog->comments()->latest()->paginate(3)" :blog="$blog"/>

  <x-blogyoumaylike :randomBlogs="$randomBlogs" />
</x-layout> 