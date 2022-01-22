<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;

class PostController extends Controller
{

    /**
     * @return View|Factory
     * @throws BindingResolutionException
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()
        ]);
    }

    /**
     * @param Post $post
     * @return View|Factory
     * @throws BindingResolutionException
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
