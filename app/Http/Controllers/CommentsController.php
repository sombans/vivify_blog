<?php

namespace App\Http\Controllers;
use App\Mail\CommandRecieved;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function store($postId)
    {
        $post = Post::find($postId);

        $this->validate(request(), Comment::STORE_RULES);

        $post->comments()->create(request()->all());

        mail::to($post->user)
        ->send(new CommandRecieved($post));

        return redirect()->route('single-post', ['id' => $postId]);
    }
}
