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
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('report.bbs')}}">


            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหาข้อมูล</h4>
                </div>


                <div class="panel-body">

                    <div class="form-group">
                        <label for="depart_no" class="col-md-2 control-label">From Date : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date1" name="document_date1" required>

                            </div>

                        </div>
                        <label for="depart_no" class="col-md-1 control-label">To Date : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date2" name="document_date2" required>



                            </div>
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="depart_no" class="col-md-2 control-label"> </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <button type="submit" class="btn btn-success" id="submit_id">ค้นหาข้อมูล</button>

                            </div>

                        </div>
                        <label for="depart_no" class="col-md-1 control-label"> </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type=button value="แสดงข้อมูล" class="btn btn-warning" onClick="javascript:location.reload();">



                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <div class="panel panel-danger" >


                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ข้อมูล</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">
                        <input type="hidden" id="user_log" value="">
                        <input type="hidden" id="date_bbs" value="">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>ชื่อหัวหน้างาน</th>
                                <th>จำนวนที่ทำ BBS</th>
                                <th>ไอดี</th>
                                <th>สถานะ</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach($report as $report1)
                                <tr data-tr="{{$report1->date_time}}">
                                    <td>{{$report1->date_time}}</td>
                                    <td>{{$report1->name_r}}</td>
                                    <td>{{$report1->bbs}}</td>
                                    <td>{{$report1->user_login}}</td>
                                    <td>@if ($report1->bbs > 7)

                                            <button type="button" class="label label-success" onclick="myFunction('{{$report1->user_login}}','{{$report1->date_time}}')">complete</button>
                                        @else
                                            <button type="button" class="label label-danger" onclick="myFunction('{{$report1->user_login}}','{{$report1->date_time}}')">incomplete</button>
                                        @endif</td>






                                    </th>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label> รายละเอียด BBS </h4>
                        </div>
                        <div class="modal-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_pb">
                                    <thead>
                                    <tr>
                                        <th>ชื่อผู้ออกBBS</th>
                                        <th>ชื่อผู้โดนBBS</th>
                                        <th>ข้อ 1</th>
                                        <th>ข้อ 2</th>
                                        <th>ข้อ 3</th>
                                        <th>ข้อ 4</th>
                                        <th>ข้อ 5</th>
                                        <th>ข้อ 6 อื่นๆ</th>
                                        <th>ข้อ 7</th>
                                        <th>ตวรจสอบใบขับขี่</th>
                                        <th>ชนิดใบขับขี่</th>


                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal" onclick="save_data()">ตกลง</button>-->




                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>



                    </div>

                </div>
            </div>






        </form>
    </div>
@endsection


@section('javascript')

    <script>


        $(function(){
            $('table').dataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                "order": [[ 0, "desc" ]],
                iDisplayLength: -1,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf',
                ]

            });
        });




        function onDelete (id) {

            var result = confirm("Want to delete?");
            if (result) {
                //Logic to delete the item
                $.get('/user_login/delete/'+id,function (r) {

                    $('[data-tr='+id+']').remove();

                });
            }

        }



        function myFunction($x,$xx){
            document.getElementById("user_log").value = $x;
            document.getElementById("date_bbs").value = $xx;
            var user_log=$('#user_log').val();
            var date_bbs=$('#date_bbs').val();



            $('#myModal').modal('show');//now its working


            $.ajax({
                type :'get',
                url: "/BBS/Report/query",
                data: {user_log:user_log,date_bbs:date_bbs},
                dataType: 'json',
                success : function(data){
                    var rrrow ='';
                    var $table = $('#table_pb').DataTable();

                    $table.clear().draw();
                    $.each(data,function(index,value) {



                        $table.row.add( [
                            value.user_login.trim(),
                            value.name_user_bbs.trim(),
                            value.S1.trim(),
                            value.S2.trim(),
                            value.S3.trim(),
                            value.S4.trim(),
                            value.S5.trim(),
                            value.S6.trim(),
                            value.S7.trim(),
                            value.S8.trim(),
                            value.drive1.trim(),






                        ]).draw();

                    });

                }


            });
        }

        $('#document_date1').datetimepicker({
            format: 'YYYY-MM-DD',

            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o',
                close: 'fa fa-close'}

        });

        $('#document_date2').datetimepicker({
            format: 'YYYY-MM-DD',

            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o',
                close: 'fa fa-close'}

        });


    </script>

@endsection
