<x-admin-layout>
    <h3 class="text-secondary text-center mb-4">Blogs</h3>
    <table class="table border p-3 mb-5">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Blog Tile</th>
            <th scope="col">Blog Intro</th>
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($blogs as $key=>$blog)
            <tr>
                <th class="px-3">{{$key + $blogs->firstItem()}}</th>
                <td>{{$blog->title}}</td>
                <td>{{$blog->intro}}</td>
                <td><a href="" class="btn btn-primary">Edit</a></td>
                <td><form action="/admin/blogs/{{$blog->slug}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
    {{$blogs->links()}}
</x-admin-layout>