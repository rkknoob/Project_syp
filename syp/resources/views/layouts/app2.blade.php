<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SYP EASY REAL TIME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{!!asset('images/icon2.ico')!!}">
    <link rel="apple-touch-icon" href="{!!asset('images/icon2.ico')!!}">
    <link rel="apple-touch-icon-precomposed" href="{!!asset('images/icon2.ico')!!}">



    @include('includes.css')

    @yield('css')

</head>

    <body>

        <body class="">

        <!-- Overlay Div -->



           <!-- //คำสั่งให้หน้าอื่นใช้งาน -->
            <div class="login-wrapper">
                @yield('content.login')
            </div><!-- /login-wrapper -->




            <div id="wrapper" class="preload">

                @yield('content')

            </div><!-- /wrapper -->

            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}"></script>


            <!-- Include this after the sweet alert js file -->



        @include('includes.footer')

        <!-- Le javascript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        @include('includes.jquery')

        @yield('javascript')



        </body>
</html>

