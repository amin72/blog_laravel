@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Results for {{ $keyword }}</div>
                
                    <div class="panel-body">

                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                                <img style="width: 100%; height:180px;" src="/storage/cover_images/{{ $post->cover_image }}" alt="">
                                            </a>
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3>
                                            <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No posts found</p>
                        @endif

                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
