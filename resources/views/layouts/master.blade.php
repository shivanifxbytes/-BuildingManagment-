<!DOCTYPE html>
<html class="no-js">
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>{{ __('messages.project_name')}}</title>
            <meta name="description" content="">	
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet">
            <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet" />
    </head>
    <body>
          <!--Header-part-->
                  @include('includes.header')     
          <!--end-Header-part-->
          <!-- Dynamic content Section -->
          <main role="main" class="container">
                   @yield('content')
          </main>
          <!-- end-dynamic content Section-->
          <!--Footer-part-->
          @include('includes.footer')        
          <!--end-Footer-part-->  
    </body>
</html>
