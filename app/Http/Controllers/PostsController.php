<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;


class PostsController extends Controller
{
    private $knowledge_levels = ['None', 'Beginner', 'Intermediate', 'Advanced', 'Professional'];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'knowledge_level' => 'required|min:0|max:4'
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
          // get filename with ext
          $filename_with_ext = $request->file('cover_image')->getClientOriginalName();
          // get filename
          $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
          // get extension
          $extention = $request->file('cover_image')->getClientOriginalExtension();

          $filename_to_store = $filename . "_" . time() . "." . $extention;
          $request->file('cover_image')->storeAs('public/cover_images', $filename_to_store);
        }
        else
        {
            $filename_to_store = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filename_to_store;
        $post->knowledge_level = $request->knowledge_level;
        $post->save();

        return redirect(route('dashboard'))->with('success', 'Post Created');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with(
            ['post' => $post, 'knowledge_level' => $this->knowledge_levels[$post->knowledge_level]]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // check for correct user
        if (auth()->user()->id !== $post->user_id)
        {
            return redirect(route('posts.index'))->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with(
            ['post' => $post, 'knowledge_level' => $this->knowledge_levels[$post->knowledge_level]]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'knowledge_level' => 'required|min:0|max:4'
        ]);

        $post = Post::find($id);

        // check for correct user
        if (auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        // Handle file upload
        if ($request->hasFile('cover_image'))
        {
            // get filename with ext
            $filename_with_ext = $request->file("cover_image")->getClientOriginalName();
            // get filename
            $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
            // get extension
            $extention = $request->file('cover_image')->getClientOriginalExtension();

            $filename_to_store = $filename . "_" . time() . "." . $extention;
            $request->file('cover_image')->storeAs('public/cover_images', $filename_to_store);
            
            // delete old image
            $path = 'public/cover_images/' . $post->cover_image;
            $exists = Storage::exists($path);
            if ($exists)
            {
                Storage::delete($path);
            }

            // replace cover image with new image
            $post->cover_image = $filename_to_store;
        }


        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->knowledge_level = $request->knowledge_level;
        $post->save();

        return redirect(route('posts.show', ['post' => $post]))->with('success', 'Post Updated');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);

      // check for correct user
      if (auth()->user()->id !== $post->user_id) {
        return redirect('/posts')->with('error', 'Unauthorized Page');
      }

      if ($post->cover_image != 'noimage.jpg') {
        Storage::delete('public/cover_images/' . $post->cover_image);
      }

      $post->delete();
      return redirect('/posts')->with('success', 'Post Removed');
    }
}
