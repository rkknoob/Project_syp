@extends('layouts.endless3')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายงาน</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('report.person')}}">


            <div class="panel panel-primary " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหาข้อมูลตามวันที</h4>
                </div>


                <div class="panel-body">

                    <div class="form-group">
                        <label for="depart_no" class="col-md-3 control-label">Date : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date1" name="document_date1" required>
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
                    </div>
                </div>
            </div>


            <div class="panel panel-primary" >


                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> รายงานส่วนตัวที่ออกแผนพัฒนา</h4>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="user_log" value="">
                    <input type="hidden" id="date_bbs" value="">

                    <input type="hidden" id="user_code" value="{{$user_id}}">
                    <input type="hidden" id="date_time" name="date_time" value="{{$date_time}}">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>หัวข้อ</th>
                            <th>สอนงาน</th>
                            <th>แผนพัฒนา</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr data-tr="{{$user->mistake_code}}">
                                <td>{{$user->mistake_code}}:{{$user->description_mistake}}</td>
                                <td>{{$user->Coach}}</td>
                                <td>{{$user->Devolop}}</td>
                                <th>
                                    <button type="button" class="label label-success" onclick="myFunction('{{$user->mistake_code}}','{{$date_time}}')">Details</button>

                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label>รายงานตามบุคคลที่บันทึกข้อมูล</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_pb">
                                    <thead>
                                    <tr>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>ประเภท</th>
                                        <th>เวลา</th>
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
                "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "iDisplayLength": 25,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel'
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


        function myFunction($x,$xx){
            document.getElementById("user_log").value = $x;


            var mistake_code=$('#user_log').val();
            var user_code=$('#user_code').val();
            var date_time=$('#date_time').val();


            $('#myModal').modal('show');//now its working

            $.ajax({
                type :'get',
                url: "/report/Person/show",
                data: {mistake_code:mistake_code,user_code:user_code,date_time:date_time},
                dataType: 'json',
                success : function(data){

                    var rrrow ='';
                    var $table = $('#table_pb').DataTable();

                    $table.clear().draw();
                    $.each(data,function(index,value) {



                        $table.row.add( [
                            value.namet.trim(),
                            value.type_warning.trim(),
                            value.date_time.trim(),







                        ]).draw();

                    });

                }


            });
        }


    </script>

@endsection
