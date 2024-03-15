<!-- blogs section -->
@props(['blogs'])
<section class="container text-center" id="blogs">
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>
    <div class="">
      <x-category-dropdown/>
      {{-- <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          Dropdown link
        </a>
      
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div> --}}
    </div>
    <form action="/" method="GET" class="my-3">
      <div class="input-group mb-3">
        <input
          type="text"
          autocomplete="false"
          value="{{request('search')}}"
          class="form-control"
          name="search"
          placeholder="Search Blogs..."
        />
        @if(request('category'))
          <input
            type="hidden"
            value="{{request('category')}}"
            name="category"
          />
        @endif
        @if(request('username'))
          <input
            type="hidden"
            value="{{request('username')}}"
            name="username"
          />
        @endif
        <button
          class="input-group-text bg-primary text-light"
          id="basic-addon2"
          type="submit"
        >
          Search
        </button>
      </div>
    </form>
    <div class="row">
      {{-- @if($blogs->count())
        @foreach($blogs as $blog)
            <x-blogcard :blog="$blog"></x-blogcard>
        @endforeach
      @else
        <p class="text-ceter">No Blog Found</p>
      @endif --}}

      @forelse ($blogs as $blog)
        <x-blogcard :blog="$blog"></x-blogcard>
      @empty
         <p class="text-center">No Blog Foud</p> 
      @endforelse
      
      <div class="d-flex">
        {{$blogs->links()}}
      </div>
    </div>
  </section>