@extends('layouts.endless')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="panel-body">
                <div class="text-center">
                <a class="btn btn-app" href="{{Route('home')}}">
                    <i class="fa fa-home fa-5x"></i>หน้าหลัก
                </a>
                <a class="btn btn-app" href="{{Route('find_user.index')}}">
                    <i class="fa fa-address-card fa-5x"></i> บันทึกข้อผิดพลาด
                </a>
                    <a class="btn btn-app" href="{{Route('workdaily.index')}}">
                        <i class="fa fa-eercast fa-5x"></i> งานประจำวัน
                    </a>
                    <a class="btn btn-app" href="{{Route('report.index')}}">
                        <i class="glyphicon glyphicon-list-alt"></i>   รายงาน
                    </a>

                    <a class="btn btn-app" href="{{Route('count.index')}}" hidden>
                        <i class="fa fa-address-card fa-5x"></i> Count Sheet
                    </a>


                    <a class="btn btn-app" href="{{Route('BBS.index')}}">
                        <i class="glyphicon glyphicon-book"></i>การสังเกตุพฤติกรรม
                    </a>

                    <a class="btn btn-app" href="{{Route('document.readdocment')}}">
                        <i class="glyphicon glyphicon-book"></i>เอกสารแจ้งเตือน
                    </a>

                    <a class="btn btn-app" href="{{Route('viewback.index')}}">
                        <i class="fa fa-address-card fa-5x"></i> ดูข้อมูลย้อนหลัง
                    </a>
                    <a class="btn btn-app" href="{{Route('daily_load.index')}}">
                        <i class="fa fa-eercast fa-5x"></i> Daily Load
                    </a>

                    @if (Auth::user()->Type_depart == '2')

                        <a class="btn btn-app" href="{{Route('admin.index')}}" aria-hidden="true">
                            <i class="fa fa-user-circle-o fa-5x"></i>   ผู้ดูแลระบบ
                        </a>

                    @endif
                    {{ csrf_field() }}
            </div>
        </div>
        </div>
</div>
@endsection
