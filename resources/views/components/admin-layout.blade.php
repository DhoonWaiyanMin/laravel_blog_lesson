<x-layout>
    <div class="container">
        <div class="row justify-content-between align-items-start">
            <div class="col-md-2 mt-2">
                <ul class="list-group mt-5">
                    <li class="list-group-item"><a href="{{ route('adminblogs.index') }}" class="nav-link">Dashboard</a></li>
                    <li class="list-group-item"><a href="{{route('blogs.create')}}" class="nav-link">Create Blog</a></li>
                  </ul>
            </div>
            <div class="col-md-10">
                {{$slot}}
            </div>
        </div>
    </div>
</x-layout>