<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(6);
        return view('admin.blogs.index',['blogs'=>$blogs]);
    }

    public function create(){
        return view('blogs.create',['categories' => Category::all()]);
    }

    public function store(){
        
        $formData = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('blogs','slug')],
            'intro' => 'required',
            'body' => 'required | min : 100',
            'thumbnail' => 'required | mimes:jpg,jpeg,png',
            'category_id' => ['required' , Rule::exists('categories','id')]
        ]);
        $path = request()->file('thumbnail')->store('thumbnails');
        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = $path;
        Blog::create($formData);

        return redirect('/');
    }

    public function edit(Blog $blog){
        return view('admin.blogs.edit',[
            'blog'=>$blog,
            'categories'=> Category::all()
        ]);
    }

    public function update(Blog $blog){
        $formData = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('blogs','slug')->ignore($blog->id)],
            'intro' => 'required',
            'body' => 'required | min : 100',
            'thumbnail' => 'mimes:jpg,jpeg,png',
            'category_id' => ['required' , Rule::exists('categories','id')]
        ]);

        $formData['thumbnail'] = request()->file('thumbnail') ? request()->file('thumbnail')->store('thumbnails') : $blog->thumbnail;
        
        $formData['user_id'] = auth()->id();
        $blog->update($formData);

        return redirect('/');
    }

    public function destroy(Blog $blog){
        $blog->delete();
        return redirect()->back()->with('success',"Blog Deleted Successfully");
    }
}
