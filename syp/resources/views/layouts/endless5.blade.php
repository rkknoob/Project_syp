<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SYP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <link rel="shortcut icon" href="{!!asset('images/icon2.ico')!!}">

    <link rel="apple-touch-icon" href="{!!asset('images/icon2.ico')!!}">
    <link rel="apple-touch-icon-precomposed" href="{!!asset('images/icon2.ico')!!}">

    {!! Charts::styles() !!}



    <meta name="csrf-token" content="{{ csrf_token() }}">



    @include('sweet::alert')
    @include('includes.css2')
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

            <div id="wrapper" class="preload">
                <div id="main-container">
                    @yield('content')
                </div><!-- /main-container -->
            </div><!-- /wrapper -->
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}"></script>
            <!-- Include this after the sweet alert js file -->
        @endif

        <!-- Le javascript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        @include('includes.jquery2')
        @include('includes.class_funtion')
        @yield('javascript')
        </body>
    </body>
</html>

