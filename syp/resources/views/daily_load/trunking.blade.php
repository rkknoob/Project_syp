@extends('layouts.endless')

@section('content')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายการ Trunking</li>

        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            {{ csrf_field() }}


            <div class="panel panel-primary" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-eercast"></i>รายการ Trunking</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>TripID</th>
                                <th>ตู้</th>
                                <th>เวลาคาดว่าจะถึง</th>
                                <th>สถานะ</th>
                                <th>เลือก</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data_trunk as $data_trunk2)
                                <tr data-tr="{{$data_trunk2->trin}}">

                                    <td>{{ \Carbon\Carbon::parse($data_trunk2->day_upload)->format('d/m/Y')}}</td>
                                    <td>{{$data_trunk2->trin}}</td>
                                    <td>{{$data_trunk2->trailer_no}}</td>
                                    <td>{{$data_trunk2->arrivestore}}</td>
                                    <td>
                                        @if ($data_trunk2->status_trunk == 'N')

                                            ยังไม่ลงเวลา
                                        @else

                                        @endif</td>



                                    <th>


                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="att_data('<?php echo $data_trunk2->trin?>','<?php echo $data_trunk2->trailer_no;?>')">ลงเวลา</button>



                                    </th>
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
                        <input type="hidden" id="trailer_no">
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
            $("#trailer_no").val(x2);


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

            trailer_no
            var trip_id=$('#trip_id_x').val();
            var trailer_no=$('#trailer_no').val();





            $.ajax({
                type: 'get',
                url:  '/daily_load/index/trunk/update/',
                data: {trip_id:trip_id,trailer_no:trailer_no},
                success: function( msg ) {


                    if(msg.trim()=='1'){
                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');

                        swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {
                            button: false,
                        });

                        setTimeout(function(){  window.location = '{{route('daily_load.trunking')}}'; }, 1000);


                    }else if (msg.trim()=='2'){

                        swal("Error!", "ข้อมูลนี้ถูกบันทึกไปก่อนหน้านี้", "error", {
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
