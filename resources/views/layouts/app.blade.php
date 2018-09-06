<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LSAPP') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-slider.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      @include('inc.navbar')

      <div class="container">
        @include('inc.messages')
        @yield('content')
      </div>
    </div>

    <footer class="footer" style="padding-bottom: 12px;">
      <div class="container">
        <hr>        
        <p class="text-muted">© 2018 Copyright: <a href="#">LocalBox</a></p>
      </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-slider.min.js') }}"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    
    <script>

        // Slider
        var knowledge_level = ['None', 'Beginner', 'Intermediate', 'Advanced', 'Professional'];
        $('#knowledge_level').slider({
            formatter: function(value) {
                return 'Knowledge Level: ' + knowledge_level[value];
            }
        });

    </script>


</body>
</html>
