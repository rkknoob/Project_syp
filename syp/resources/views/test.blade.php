@extends('layouts.endless3')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายงาน BBS</li>
        </ul>
    </div><!-- breadcrumb -->


    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            <div class="panel panel-danger" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ข้อมูลที่ไม่มีการเคลียร์</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">


                    </div>
                </div>
            </div>









        </form>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">


                        {!! $chart->html() !!}
                        {!! Charts::scripts() !!}
                        {!! $chart->script() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')

    <script>

    </script>

@endsection
