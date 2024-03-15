<x-layout>
    <x-slot name="title">Register</x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h3 class="text-center text-primary my-3">Register From</h3>
                <div class="card shadow-sm p-4 my-3">
                    <form action="/register" method="POST">
                        @csrf
                        <x-form.input name="name"/>
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">User name</label>
                            <input type="text" class="form-control" name="username" id="exampleInputEmail1" value="{{old('username')}}">
                            @error('username')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                          <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{old('email')}}">
                          @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                          @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>