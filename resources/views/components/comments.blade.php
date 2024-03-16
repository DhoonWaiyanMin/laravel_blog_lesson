<section class="container my-4">
  
    <div class="card w-50 mx-auto rounded">
      @if($comments->count())

        <div class="card-header">
          <h5 class="text-secondary">Comments</h5>
        </div>
        <div class="card-body h-25 scroll-y">


          @foreach ($comments as $comment)
              <x-single-comment :comment="$comment"/>
          @endforeach
        
        </div>

        {{$comments->links()}}

      @endif

      @if(auth()->user())
        <div class="card-footer">
            <form action="/blogs/{{$blog->slug}}/comment" method="POST">
              @method('POST')
              @csrf
              <div class="d-flex justify-content-between align-items-center">
                <textarea name="comment" rows="1" style="resize: none; " class="w-75 form-control border-0" placeholder="say something"></textarea>
                {{-- <input type="text" name="comment" class="form-control w-75 border-0" placeholder="say something..."/> --}}
                <button class="w-25 btn btn-sm btn-secondary">Send</button>
              </div>
            </form>
            <x-error error="comment"/>
        </div>
      
      @else
        <p class="text-secondary mx-auto">Please login to participate in comment discussion.</p>
      @endif

    </div>
  </section>