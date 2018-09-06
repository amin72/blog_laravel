@extends('layouts.app')

@section('content')
    <div class="page-header text-info">
        <!--<h1>Posts</h1>-->
        <form method="GET" action="{{ route('posts-list') }}">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search Posts" value="{{ old('search') }}">
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1">
                    <div class="form-group">
                        <button class="btn btn-success">Search</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    @if (count($posts) > 0)
        @foreach ($posts as $post)
                <div class="row well">
                    <div class="col-md-3 col-sm-4 col-xs-5">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            <img style="width: 100%; height:180px;" src="/storage/cover_images/{{ $post->cover_image }}" alt="">
                        </a>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3>
                        <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small>
                    </div>
                </div>
            <!--</div>-->
        @endforeach
        
        {{ $posts->links() }}
    @else
        <p>No posts found</p>
    @endif

    @if (Auth::check())
        <div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
        </div>
    @endif
@endsection
