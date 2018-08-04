@extends('layouts.endless3')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายงาน Syp Report</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            <div class="panel panel-danger" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> Chart แสดงข้อมูล</h4>
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
            </div>



        </form>

    <div class="panel panel-danger" >


        <div class="panel-heading">
            <h4> <i class="fa fa-address-card "></i> ข้อมูลแผนก</h4>
        </div>

        <div class="panel-body">

            <div class="table-responsive">
                <div class="panel-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>แผนก</th>
                            <th>จำนวนพนักงาน</th>
                            <th>จำนวนพนักงานที่ยังติด</th>
                            <th>จำนวนพนักงานที่แก้ไข</th>
                            <th>วันที่เก่าสุด</th>
                            <th>ระยะเวลา</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $results2)
                            <tr>
                                <td>{{$results2->num}}</td>
                                <td>{{$results2->Dept_de}}</td>
                                <td>{{$results2->cnt_dept}}</td>
                                <td>{{$results2->cnt_deptN}}</td>
                                <td>{{$results2->cnt_deptY}}</td>
                                <td>{{ \Carbon\Carbon::parse($results2->old_day)->format('d/m/Y')}}</td>
                                <td>{{$results2->ditss}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection


@section('javascript')


    <script>

        $(function(){
            $('table').dataTable({
                "lengthMenu": [[ -1], ["All"]],
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel',
                ]

            });
        });



    </script>


@endsection
