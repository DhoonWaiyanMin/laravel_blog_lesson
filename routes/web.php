<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/register",[AuthController::class,'create'])->middleware('guest');
Route::post("/register",[AuthController::class,'store'])->middleware('guest');
Route::post("/logout",[AuthController::class,'logout'])->middleware('auth');
Route::get("/login",[AuthController::class,'login'])->middleware('guest');
Route::post("/login",[AuthController::class,'postLogin'])->middleware('guest');

Route::get("/",[BlogController::class,'index']);
Route::get('blogs/{blog:slug}' , [BlogController::class,'show']);
Route::post('blogs/{blog:slug}/comment',[CommentController::class,'store']);
Route::post('blogs/{blog:slug}/subscription',[BlogController::class ,"handleSubscribe"]);

// Admin Routes 
// Route::get('admin/blogs',[AdminBlogController::class,'index'])->middleware('admin')->name('adminblogs.index');
// Route::get('admin/blogs/create',[AdminBlogController::class,'create'])->middleware('admin');
// Route::get('admin/blogs/{blog:slug}/edit',[AdminBlogController::class,'edit'])->middleware('admin');
// Route::patch('admin/blogs/{blog:slug}/update',[AdminBlogController::class,'update'])->middleware('admin');
// Route::delete('admin/blogs/{blog:slug}',[AdminBlogController::class,'destroy'])->middleware('admin');
// Route::post('admin/blogs/create',[AdminBlogController::class,'store'])->middleware('admin')->name('blogs.create');

// use authorize gate as a middleware 
// Route::get('admin/blogs',[AdminBlogController::class,'index'])->middleware('can:admin')->name('adminblogs.index');
// Route::get('admin/blogs/create',[AdminBlogController::class,'create'])->middleware('can:admin');
// Route::get('admin/blogs/{blog:slug}/edit',[AdminBlogController::class,'edit'])->middleware('can:admin');
// Route::patch('admin/blogs/{blog:slug}/update',[AdminBlogController::class,'update'])->middleware('can:admin');
// Route::delete('admin/blogs/{blog:slug}',[AdminBlogController::class,'destroy'])->middleware('can:admin');
// Route::post('admin/blogs/create',[AdminBlogController::class,'store'])->middleware('can:admin')->name('blogs.create');

// route group 
Route::middleware('can:admin')->group(function(){
    Route::get('admin/blogs',[AdminBlogController::class,'index'])->name('adminblogs.index');
    Route::get('admin/blogs/create',[AdminBlogController::class,'create']);
    Route::get('admin/blogs/{blog:slug}/edit',[AdminBlogController::class,'edit']);
    Route::patch('admin/blogs/{blog:slug}/update',[AdminBlogController::class,'update']);
    Route::delete('admin/blogs/{blog:slug}',[AdminBlogController::class,'destroy']);
    Route::post('admin/blogs/create',[AdminBlogController::class,'store'])->name('blogs.create');

});







// Route::get("users/{user:username}",function(User $user){
//     return view("blogs",[
//         // "blogs" => $user->blogs->load('category','author')
//         'blogs'=>$user->blogs,
//         'categories'=>Category::all()

//     ]);
// });


// Route::get('/blog/{blog}', function ($slug) {
//     $path = __DIR__."/../resources/blogs/".$slug.".html";
//     if(!file_exists($path)){
//         // return redirect("/");
//         abort(404);
//     }
//     // file_get_content ကို ခနခန မခေါ်တော့ပဲ server ram ထဲမှာ cache အနေနဲ့ သိမ်းပြီး ပြန်ထုတ်သုံးတယ် 
//         // caceh()->remember("slug" , time in second , function )
//     $blog = cache()->remember("posts.$slug", now()->addMinute() ,function() use($path){
//         return file_get_contents($path);
//     });
//     return view('blog',[
//         "blog" => $blog
//     ]);
// })->where("blog",'[A-z\d\-_]+');
// wild card constraint with regular expression 
// })->whereAlpha("blog"); 
// })->whereAlphaNumeric("blog"); 
// wild card constraint with laravel methods

// Route::get('blogs/{blog:slug}' , [BlogController::class,'show'])->where("blog",'[A-z\d\-_]+');

// Route::get("categories/{category:slug}",function(Category $category){

//     return view("blogs",[
//         "blogs" => $category->blogs,
//         'categories'=>Category::all(),
//         'currentCategory'=>$category

//     ]);
// });