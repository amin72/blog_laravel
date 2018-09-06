<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;


class SearchPostController extends Controller
{
    public function postList(Request $request)
    {
        if ($request->has('search'))
        {
            $posts = Post::search($request->search)->orderBy('created_at', 'desc')->paginate(6);
        }
        else
        {
            $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        }
        
        return view('post-search')->with(
                ['posts' => $posts, 'keyword' => '"' . $request->search .'"']);
    }
}
