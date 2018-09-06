@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-offset-0 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <h3>Your Blog Posts</h3>
          
          @if (count($posts) > 0)
            <table class="table table-striped">
              <tr>
                <th>Title</td>
                <th class="pull-right">Actions</td>
              </tr>
              
              @foreach ($posts as $post)
                <tr>
                  <td><a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-info">{{ $post->title }}</a></td>
                  <td>
                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" class="pull-right">
                      {{ csrf_field() }}
                      {{ method_field("DELETE") }}
                      <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                      
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-success btn-sm pull-right" style="margin: 0 10px;">Edit</a>
                    
                  </td>
                </tr>
              @endforeach
              
            </table>
          @else
            <p>You have no posts</p>
          @endif
        
          
          <a href="/posts/create" class="btn btn-primary">Create New Post</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
