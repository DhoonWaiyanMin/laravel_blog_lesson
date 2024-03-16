<nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Creative Coder</a>
      <div class="d-flex">
        {{-- @if(!auth()->check())
          <a href="/register" class="nav-link">Register</a>
        @else
          <a href="" class="nav-link">{{auth()->user()->name}}</a>
        @endif --}}

        @guest
          <a href="/register" class="nav-link">Register</a>
          <a href="/login" class="nav-link">Login</a>
        @else
          <img src="{{auth()->user()->avatar}}" width="40px" height="40px" class="rounded-circle" alt=""/>
          <a href="" class="nav-link">{{auth()->user()->name}}</a>
        @endguest
        <a href="/#blogs" class="nav-link">Blogs</a>
        <a href="#subscribe" class="nav-link">Subscribe</a>
        @if(auth()->user() && auth()->user()->isAdmin)
          <a href="{{route('adminblogs.index')}}" class="nav-link">Admin Dashboard</a>
        @endif
        @auth
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="nav-link btn btn-link">Log Out</button>
          </form>
        @endauth
      </div>
    </div>
  </nav>