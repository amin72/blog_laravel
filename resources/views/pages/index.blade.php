@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <h1>Welcome to LaravelPosts Website!</h1>
    <p>This website was created with laravel framework</p>
    <p>And it let's you create and manage your posts</p>
    <p>
      @guest
        <a href="/login" class="btn btn-primary btn-lg">Login</a>
        <a href="/register" class="btn btn-success btn-lg">Register</a>
      @else
        <a href="{{ route("dashboard") }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
      @endguest
    </p>
  </div>
@endsection