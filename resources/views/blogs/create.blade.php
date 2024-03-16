<x-admin-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h3 class="text-center text-primary my-2">Create New Blog</h3>
                <div class="card shadow-sm p-4 my-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-form.input name="title"/>

                        <x-form.input name="slug"/>
                        
                        <x-form.input name="intro"/>
                        
                        <x-form.textarea name="body"/>

                        <x-form.input name="thumbnail" type="file"/>


                        <x-form.input-wrapper>
                            <x-form.label name="category"/>
                            <select class="form-select" name="category_id" id="category_id">
                                <option disabled selected>Choose Your Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id === old('category_id') ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <x-error error="category_id"></x-error>
                        </x-form.input-wrapper>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        
                        
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>