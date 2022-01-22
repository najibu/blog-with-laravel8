<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;

class PostCommentController extends Controller
{
    /**
     * @param Post $post
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(Post $post)
    {
        request()->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        return back();
    }
}
