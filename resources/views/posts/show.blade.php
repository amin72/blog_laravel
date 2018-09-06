@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{ $post->title }}</h1>
    </div>

    <div class="row">
        <img class="img-responsive col-xs-12" style="max-width: 600px;" src="/storage/cover_images/{{ $post->cover_image }}" alt="{{ $post->cover_image }}">
    </div>
  
  
    <div style="margin-top: 30px; font-size: 16px;">
        {!! $post->body !!}
    </div>
    <hr>
    <small>Created on {{ $post->created_at }} by <strong>{{ $post->user->name }}</strong></small>
    <p>Knowledge Level: <strong>{{ $knowledge_level }}</strong></p>
    
  
    @if (Auth::check())
        @if (Auth::user()->id == $post->user_id)
            <hr>
            <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-success">Edit Post</a>
      
            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display: inline">
              {{ csrf_field() }}
              {{ method_field("DELETE") }}
              <button class="btn btn-danger">Delete Post</button>
            </form>
            
        @endif
    @else
        <div style="margin-top: 20px"></div>
    @endif
    
@endsection

