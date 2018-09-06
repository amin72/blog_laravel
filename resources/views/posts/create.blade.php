@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        
        {{ csrf_field() }}
      
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Title" class="form-control">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="article-ckeditor" name="body" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="knowledge_level" style="margin-right: 30px;">Your Knowledge Level :</label>
            <input type="text" id="knowledge_level" name="knowledge_level" class="form-control" data-slider-min="0" data-slider-max="4" data-slider-step="1" data-slider-value="0">
        </div>

        <div class="form-group">
            <input type="file" name="cover_image" class="form-control">
        </div>

        <input type="submit" class="btn btn-primary">

    </form>
  
@endsection