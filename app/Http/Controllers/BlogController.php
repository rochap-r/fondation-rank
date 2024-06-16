<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->orderBy('id', 'DESC')->paginate(9);
        return view('blog.index', ['posts' => $posts]);
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.show', ['post' => $post]);
    }


}
