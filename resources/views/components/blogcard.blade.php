  <div class="col-md-4 mb-4">
    <div class="card h-100">
        @if($blog->thumbnail)
          <img src='{{asset("storage/$blog->thumbnail")}}'' class="card-img-top" alt="...">
        @else 
          <img
            src="https://creativecoder.s3.ap-southeast-1.amazonaws.com/blogs/GOLwpsybfhxH0DW8O6tRvpm4jCR6MZvDtGOFgjq0.jpg"
            class="card-img-top"
            alt="..."
          />
        @endif
        <div class="card-body">
          <h3 class="card-title">{{$blog->title}}</h3>
          <p class="fs-6 text-secondary">
           <a href="/?username={{$blog->author->username}}">{{$blog->author->name}}</a>
            <span> - {{$blog->created_at->diffForHumans()}}</span>
          </p>
          <div class="tags my-3">
            <span class="badge bg-primary"><a class="text-white text-decoration-none" href="/?category={{$blog->category->slug}}">{{$blog->category->name}}</a></span>
            {{-- <span class="badge bg-secondary">Css</span>
            <span class="badge bg-success">Php</span>
            <span class="badge bg-danger">Javascript</span>
            <span class="badge bg-warning text-dark">Frontend</span> --}}
          </div>
          <p class="card-text">
            {{$blog->intro}}
          </p>
          <a href="/blogs/{{$blog->slug}}" class="btn btn-primary">Read More</a>
        </div>
      </div>
  </div>