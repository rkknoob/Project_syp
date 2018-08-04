@extends('layouts.endless')

@section('content')

    <style>

        .message{


            color: red;
        }


    </style>




    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ออกแผนพัฒนา</li>
        </ul>
    </div><!-- breadcrumb -->

    <br>
    <div class="container">

        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            {{ csrf_field() }}

            <div class="panel panel-primary" >
                <div class="panel-heading">

                    <h4> <i class="fa fa-pencil-square-o" ></i> เพิ่ม Plan Load</h4>
                </div>


                <div class="panel-body">


                    <div class="form-group">
                        <label class="col-md-3 control-label">ทริป :</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control input-sm" id="trin" name="trin">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">หมายเลขตู้ : </label>
                        <div class="col-md-2">
                            <input type="text" class="form-control input-sm" id="trailer_no" name="trailer_no">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">วันที่เวลาคาดว่าจะถึง : </label>
                        <div class="col-md-2">
                            <input type="text" class="form-control input-sm" id="arrivestore" name="arrivestore">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">วันที่เพิ่มข้อมูล : </label>
                        <div class="col-md-2">
                            <input type="text"  class="datepicker form-control" id="day_upload" name="day_upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">ประเภท : </label>
                        <div class="col-md-2">
                            <select name="type_load" id="type_load" class="form-control ">
                                <option selected>WNDC</option>
                                <option>BBTDC</option>

                            </select>
                        </div>
                    </div>
                </div>





                <div class="panel-footer">
                    <button type="button" class="btn btn-success" id="submit_id" >เพิ่มข้อมูล</button> <a href="{{ url()->previous() }}" class="btn btn-default">กลับหน้าเดิม</a>
                </div>

            </div>

        </form>

    </div>







@endsection


@section('javascript')

    <script>

        $(":file").filestyle({buttonName: "btn-default"});



        $(function(){
            $('table').dataTable({

                "bJQueryUI": true,
                "sPaginationType": "full_numbers",


                "columnDefs": [
                    { "width": "20%", "targets": 1 }
                ]
            });



        });


        jQuery(function ($) {
            $.mask.definitions['~'] = '[+-]';








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

        $('#day_upload').datetimepicker({
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


        $('#arrivestore').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',

            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o'
            }

        });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //บันทึกค่าที่เลือก  save data



        $(document).ready(function() {
            $('#submit_id').on('click', function (e) {

                var trin=$('#trin').val();
                var trailer_no=$('#trailer_no').val();
                var arrivestore=$('#arrivestore').val();
                var day_upload=$('#day_upload').val();
                var type_load=$('#type_load').val();



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                $.ajax({

                    type: 'get',
                    url:  '/daily_load/index/createdd',
                    data: {trin:trin,trailer_no:trailer_no,day_upload:day_upload,arrivestore:arrivestore,type_load:type_load},
                    success: function( msg ) {




                        if(msg.trim()=='1'){
                            //swal('บันทึกข้อมูลเสร็จเรียบร้อย');

                            swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {


                                button: false,
                            });
                            setTimeout(function(){  window.location = '{{route('daily_load.index')}}'; }, 2000);


                        }else if(msg.trim()=='3'){


                            swal('แจ้งเตือน', 'ไม่เจอ Trip ID นี้' , 'error', {
                                button: false,
                            });
                            //     setTimeout(function(){  window.location = ''; }, 1000);
                        }else if(msg.trim()=='2'){
                            swal('แจ้งเตือน', 'User นี้ถูกเปิดใช้งานไปแล้ว' , 'error', {

                                button: false,

                            });

                            setTimeout(function(){  window.location = '{{route('daily_load.index')}}'; }, 2000);
                        }
                        else if(msg.trim()=='4'){
                            swal(
                                'แจ้งเตือน', 'Trip id เริ่มงานไปแล้ว' , 'error',{


                                    button: false,

                                });
                            //   setTimeout(function(){  window.location = ''; }, 2000);
                        }





                        // $("#ajaxResponse").append("<div>"+msg+"</div>");
                    }
                });
            });
        });








        // Send data to server instead...





    </script>




@endsection


