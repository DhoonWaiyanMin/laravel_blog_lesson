<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index(){
        // DB::listen(function($query){
        //     // Log::info("Query count");
        //     logger($query->sql);
        // });
        
        // $blogs = Blog::all();
        return view("blogs.index",[
            // "blogs" => Blog::with('category','author')->get() // eager load / lazy loading 
            'blogs'=> $this->getBlogs()
        ]);
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

    public function show(Blog $blog){
        // $blog = Blog::findOrFail($slug);
        return view('blogs.show',[
            "blog" => $blog,
            'randomBlogs'=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    protected function getBlogs(){
        // $blogs = Blog::latest();
        // if(request('search')){
        //     $blogs= $blogs->where("title",'LIKE','%'.request('search').'%')
        //                   ->orWhere("body",'LIKE','%'.request('search').'%');
        // }
        // $query = Blog::latest();
        // $query->when(request('search'),function($query,$search){
        //     $query->where("title",'LIKE','%'.$search.'%')
        //                   ->orWhere("body",'LIKE','%'.$search.'%');
        // });
        return Blog::latest()->filter(request(['search','category','username']))
                             ->paginate(6)
                            //  ->simplePaginate(6) // contain only previous & next
                             ->withQueryString();
    }

    public function handleSubscribe(Blog $blog){
        // subscribed or not 
        if(User::findOrFail(auth()->id())->isSubscribed($blog)){
            $blog->unSubscribe();
        }else{
            $blog->subsctibe();
        }

        return back();
    }
}