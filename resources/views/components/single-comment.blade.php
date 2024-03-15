<div class="border my-2 rounded px-4">
    <div class="d-flex justify-content-start">
      <div class="d-flex justify-content-start align-items-center">
        <img src="{{$comment->author->avatar}}" class="rounded-circle" width="30px" height="30px" alt="">
        <p class="me-3 text-secondary fw-bold ms-2 py-2">{{$comment->author->name}}</p>
      </div>
      <p class="text-secondary mt-2">{{$comment->created_at->diffForHumans()}}</p>
    </div>
    <p class="text-secondary rounded px-2">{{$comment->body}}</p>
</div>