<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = ["title","intro","body"];
    protected $with = ['category','author'];  // lazy loading in model then we can use without() when we don't want category and author in blogs 

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function subscribers(){
        return $this->belongsToMany(User::class,'blog_user');
    }

    public function unSubscribe(){
        $this->subscribers()->detach(auth()->id());
    }

    public function subsctibe(){
        $this->subscribers()->attach(auth()->id());
    }

    public function scopeFilter($query,$filter){
        // if(isset($filter['search'])){
            $query->when($filter['search'] ?? false,function($query,$search){
                $query->where(function($query) use($search){
                    $query->where("title",'LIKE','%'.$search.'%')
                      ->orWhere("body",'LIKE','%'.$search.'%')
                      ->orWhere("intro",'LIKE','%'.$search.'%');
                });
                
            });
            $query->when($filter['category'] ?? false,function($query,$category){
                $query->whereHas('category',function($query) use($category){
                    $query->where("slug",$category);
                });
            });
            $query->when($filter['username'] ?? false,function($query,$user){
                $query->whereHas('author',function($query) use($user){
                    $query->where("username",$user);
                });
            });
        // }
    }
}


//Logical grouping 
// (name = "mg mg" or name = 'aung aung') and age > 20