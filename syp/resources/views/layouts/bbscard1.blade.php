<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Endless Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @include('includes.css')
    @yield('css')
</head>
@if(Request::is('login'))
    <body>
@else
    <body class="">
@endif
<!-- Overlay Div -->

@if(Request::is('login'))

    //คำสั่งให้หน้าอื่นใช้งาน
    <div class="login-wrapper">
        @yield('content.login')
    </div><!-- /login-wrapper -->
@else

    @include('includes.bbshead')

<div id="wrapper" class="preload">

    @include('includes.side_bbs1')

    <div id="main-container">
        @yield('content')
    </div><!-- /main-container -->
</div><!-- /wrapper -->
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Include this after the sweet alert js file -->
@endif
@include('includes.footer')
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('includes.jquery')
@include('includes.class_funtion')

@yield('javascript')



</body>
</html>

