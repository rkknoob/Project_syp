@extends('layouts.endless')

@section('content')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายการ Summary</li>

        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('daily_load.Summary')}}">
            {{ csrf_field() }}




            <div class="panel panel-primary " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหาวันที่</h4>
                </div>


                <div class="panel-body">

                    <div class="form-group">
                        <label for="depart_no" class="col-md-2 control-label">วันที่ : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date1" name="document_date1" required>

                            </div>

                        </div>
                        <label for="depart_no" class="col-md-1 control-label">ถึง : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date2" name="document_date2" required>



                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">ค้นหาวันที่</button>
                        </div>
                    </div>


                </div>
            </div>




            <div class="panel panel-primary" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-eercast"></i>Summary</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>ทริป</th>
                                <th>ตู้</th>
                                <th>ประเภท</th>
                                <th>เวลาคาดว่าจะถึง</th>
                                <th>เวลาถึง</th>
                                <th>สถานะ</th>
                                <th>Unload</th>
                                <th>TP รับตู้</th>
                                <th>Duration</th>




                            </tr>
                            </thead>
                            <tbody>

                            @foreach($Summary_time as $Summary_time2)
                                <tr data-tr="{{$Summary_time2->trin}}">
                                    <td>{{$Summary_time2->day_upload2}}</td>
                                    <td>{{$Summary_time2->trin}}</td>
                                    <td>{{$Summary_time2->trailer_no}}</td>
                                    <td>


                                        @if ($Summary_time2->type_load == 'wndc' || $Summary_time2->type_load == 'WNDC')
                                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal"  onclick="">WNDC</button>
                                        @elseif($Summary_time2->type_load == 'bbtdc' || $Summary_time2->type_load == 'BBTDC')
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal"  onclick="">BBTDC</button>
                                        @endif

                                    </td>
                                    <td>{{$Summary_time2->arrivestore2}}</td>
                                    <td>{{$Summary_time2->time_trunk}}</td>
                                    <td>
                                        <?php
                                        if($Summary_time2->Stat == 3){

                                            echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal"  onclick="">ยังไม่ได้ลงเวลา</button>';
                                        }elseif ($Summary_time2->Stat == 1){


                                            echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal"  onclick="">Delay</button>';
                                        }else {

                                            echo '<button type="button" class="btn btn-success btn-xs" data-toggle="modal"  onclick="">On time</button>';

                                        }

                                        ?>

                                    </td>
                                    <td <?php

                                        $add_min = date("Y-m-d H:i:s", strtotime($Summary_time2->time_trunk));
                                        $add_min2 = date("Y-m-d H:i:s", strtotime($Summary_time2->time_receive . "-30 minutes"));

                                        if($add_min == '1970-01-01 07:00:00'){






                                        }
                                        if(($add_min2 > $add_min ) &&($add_min != '1970-01-01 07:00:00')){

                                            echo "bgcolor=#FFD700";

                                        }

                                        if(($add_min2 < $add_min ) &&($add_min != '1970-01-01 07:00:00')){

                                            echo "bgcolor=#7FFF00";

                                        }








                                        ?>







                                    ><?php
                                        if ($Summary_time2->time_receive != ''){

                                            echo $Summary_time2->time_receive;
                                            echo '(';
                                            echo $Summary_time2->duration_trun_receive;
                                            echo ')';
                                        }else if($Summary_time2->time_receive == null) {


                                            echo $Summary_time2->duration_trun_receive;

                                        }

                                        ?>
                                    </td>
                                    <td <?php

                                        $add_min = date("Y-m-d H:i:s", strtotime($Summary_time2->time_receive));
                                        $add_min2 = date("Y-m-d H:i:s", strtotime($Summary_time2->time_transport . "-30 minutes"));





                                        if($add_min == '1970-01-01 07:00:00'){






                                        }
                                        if(($add_min2 > $add_min ) &&($add_min != '1970-01-01 07:00:00')){

                                            echo "bgcolor=#FFD700";

                                        }

                                        if(($add_min2 < $add_min ) &&($add_min != '1970-01-01 07:00:00')){

                                            echo "bgcolor=#7FFF00";

                                        }








                                        ?>


                                    >

                                        <?php
                                        if ($Summary_time2->time_transport != ''){

                                            echo $Summary_time2->time_transport;
                                            echo '(';
                                            echo $Summary_time2->duration_receive_tran;
                                            echo ')';
                                        }else if($Summary_time2->time_transport == null) {


                                            echo $Summary_time2->duration_receive_tran;

                                        }

                                        ?>


                                    </td>
                                    <td>{{$Summary_time2->duration_trun}}</td>


                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>









        </form>
    </div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label> แจ้งเตือน ?</h4>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการยืนยันใช่ไหม</p>
                    <input type="hidden" id="data_sent">

                </div>

                <div class="modal-body">
                    <form>
                        <input type="hidden" id="trip_id_x">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="save_data()">ตกลง</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('javascript')

    <script>



        $(function(){
            $('table').dataTable({
                "order": [[ 0, "desc" ]],

                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "visible": false,
                        "searchable": false
                    }

                ],
                "lengthMenu": [ [50, 75, 100, 200, -1], [50, 75, 100, 200, "All"] ]





            });


        });



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
        function onDelete (mistake_code) {

            var result = confirm("Want to delete?");

            if (result) {
                //Logic to delete the item
                $.get('/admin/typemistake/'+mistake_code,function (r) {

                    $('[data-tr='+mistake_code+']').remove();

                });
            }

        }

        function att_data(xx,x2)
        {

            $("#trip_id_x").val(xx);
            $("#recipient_name1").val(x2);


        }

        function save_data() {
            window.location = $("#data_sent").val();
        }



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //บันทึกค่าที่เลือก  save data
        function save_data() {


            var trip_id=$('#trip_id_x').val();





            $.ajax({
                type: 'get',
                url:  '/daily_load/index/trunk/update/',
                data: {trip_id:trip_id},
                success: function( msg ) {


                    if(msg.trim()=='1'){
                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');

                        swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {
                            button: false,
                        });

                        setTimeout(function(){  window.location = '{{route('daily_load.trunking')}}'; }, 2000);


                    }





                    // $("#ajaxResponse").append("<div>"+msg+"</div>");
                }
            });


            //alert(link_sent);
        }



    </script>

@endsection
