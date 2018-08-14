<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/base.css')}}">

    @yield('styles')
  </head>
  <body>
    @include('partials.header')
    <div class="container">
      @yield('content')
    </div>


     <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/app.js') }}"></script>
   
      @yield('scripts')
  </body>
</html>
