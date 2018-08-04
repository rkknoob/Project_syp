@extends('layouts.app2')

@section('content')
    <div class="container">
        <div class="login-wrapper">
            <div class="text-center">
                <h2 class="fadeInUp animation-delay8" style="font-weight:bold">
                    <span class="text-success">Support Your</span> <span style="color:#ccc; text-shadow:0 1px #fff">Performance</span>
                </h2>
            </div>
            <div class="login-widget animation-delay1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <i class="fa fa-lock fa-lg"></i> Login
                        </div>


                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                @if (Route::has('login'))
                                    @auth
                                        <div class="text-center">
                                        <a class="btn btn-app" href="{{Route('home')}}">
                                            <i class="fa fa-home fa-5x"></i>หน้าหลัก
                                        </a>

                                        @else
                                <label>Username</label>

                                <input id="user_code" type="user_code" class="form-control input-sm bounceIn animation-delay2" name="user_code" value="" required autofocus>


                            </div>
                            <div class="form-group">
                                <label>Password</label>

                                <input id="password" type="password"class="form-control input-sm bounceIn animation-delay4" name="password" required>
                            </div>
                                        <div class="form-group{{ $errors->has('user_code') ? ' has-error' : '' }}">
                                        @if ($errors->has('user_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('user_code') }}</strong>
                                    </span>
                                        @endif
                                        </div>

                            <hr/>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    @endauth
                                    @endif

                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /panel -->
        </div><!-- /login-widget -->
    </div><!-- /login-wrapper -->

@endsection
