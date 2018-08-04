@extends('layouts.endless')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="panel-body">
                <div class="text-center">
                    <a class="btn btn-app" href="{{Route('home')}}">
                        <i class="fa fa-home fa-5x"></i>หน้าหลัก
                    </a>
                    <a class="btn btn-app" href="{{Route('admin.typemistakeindex')}}">
                        <i class="fa fa-file-text fa-5x"></i>  ประเภทข้อผิดพลาด
                    </a>





                </div>
            </div>
        </div>
    </div>
@endsection
