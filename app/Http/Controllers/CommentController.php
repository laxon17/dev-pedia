<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    final public function store()
    {
        $attributes = request()->validate([
            'body' => ['required']
        ]);

        $attributes['post_id'] = request('post_id');
        $attributes['user_id'] = auth()->id();

        Comment::create($attributes);
    }
}
