@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายงาน</li>
        </ul>
    </div><!-- breadcrumb -->

        <div class="box-body">
            <div class="panel-body">
                <div class="text-center">

                    <a class="btn btn-app" href="{{Route('report.week')}}">
                        <i class="fa fa-file-text"></i>รายงานทั่วไป
                    </a>
                    <a class="btn btn-app" href="{{Route('report.person')}}">
                        <i class="fa fa-file"></i> รายงานส่วนบุคคล
                    </a>

                    <a class="btn btn-app" href="{{Route('report.bbs')}}">
                        <i class="fa fa-file"></i> รายงานBBS Card
                    </a>

                    <a class="btn btn-app" href="{{Route('report.report_count1')}}">
                        <i class="fa fa-file"></i> รายงานCount_1
                    </a>

                    <a class="btn btn-app" href="{{Route('report.report_count2')}}">
                        <i class="fa fa-file"></i> รายงานCount_2
                    </a>

                    <a class="btn btn-app"href="{{Route('report.datatemp_notclear')}}" hidden>
                        <i class="fa fa-file"></i> รายงานติดReport
                    </a>



                </div>
            </div>
        </div>

@endsection
