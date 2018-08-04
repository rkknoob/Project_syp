<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Endless Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>


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





<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('includes.jquery')

@yield('javascript')



</body>
</html>

