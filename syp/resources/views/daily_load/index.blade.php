@extends('layouts.endless')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="panel-body">
                <div class="text-center">
                    <a class="btn btn-app" href="{{Route('home')}}">
                        <i class="fa fa-home fa-5x"></i>หน้าหลัก
                    </a>

                    <a class="btn btn-app" href="{{Route('daily_load.created')}}">
                        <i class="glyphicon glyphicon-plus"></i>  เพิ่ม Plan Load
                    </a>
                    <a class="btn btn-app" href="{{Route('daily_load.trunking')}}">
                        <i class="fa fa-file-text fa-5x"></i>  รายการTrunking
                    </a>

                    <a class="btn btn-app" href="{{Route('daily_load.receive')}}">
                        <i class="fa fa-file-text fa-5x"></i>  รายการReceive
                    </a>
                    <a class="btn btn-app" href="{{Route('daily_load.transport')}}">
                        <i class="fa fa-eercast fa-5x"></i>   รายการ Transport
                    </a>
                    <a class="btn btn-app" href="{{Route('daily_load.Summary')}}">
                        <i class="fa fa-eercast fa-5x"></i>   Summary
                    </a>



                </div>
            </div>
        </div>
    </div>
@endsection
