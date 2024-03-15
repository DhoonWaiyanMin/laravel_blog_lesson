<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMail;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Blog $blog){
        request()->validate([
            'comment' => 'required | min:3'
        ]);
        // Method 1 
        // $comment = new Comment();
        // $comment->body = request('comment');
        // $comment->user_id = auth()->user()->id;
        // $comment->blog_id = $blog->id;
        // $comment->save();
        // return redirect()->back();

        // Mehod 2 
        $blog->comments()->create([
            'body' => request('comment'),
            'user_id' => auth()->user()->id
        ]);
        // return back();

        $subscribers = $blog->subscribers->filter(fn ($subscriber) => $subscriber->id !== auth()->id());
        
        $subscribers->each(function ($subscriber) use($blog){
            // Mail::to($subscriber->email)->send(new SubscriberMail($blog));
            Mail::to($subscriber->email)->queue(new SubscriberMail($blog));
        });

        return redirect('/blogs/'.$blog->slug);
    }
}
