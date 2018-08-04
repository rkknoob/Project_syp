@extends('layouts.endless')

@section('content')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายการ Transport</li>

        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            {{ csrf_field() }}


            <div class="panel panel-primary" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-eercast"></i>รายการ Transport</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>วัน</th>
                                <th>ทริป</th>
                                <th>ตู้</th>
                                <th>เวลาUnloadเสร็จ</th>
                                <th>ระยะเวลา</th>
                                <th>เลือก</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data_transport as $data_transport2)
                                <tr data-tr="{{$data_transport2->trin}}">

                                    <td>{{ \Carbon\Carbon::parse($data_transport2->day_upload)->format('d/m/Y')}}</td>
                                    <td>{{$data_transport2->trin}}</td>
                                    <td>{{$data_transport2->trailer_no}}</td>
                                    <td>{{$data_transport2->time_receive}}</td>
                                    <td>{{$data_transport2->duration_receive_tran}}</td>




                                    <th>


                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="att_data('<?php echo $data_transport2->trin;?>')">Hook</button>



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
                url:  '/daily_load/index/transport/update/',
                data: {trip_id:trip_id},
                success: function( msg ) {


                    if(msg.trim()=='1'){
                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');

                        swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {
                            button: false,
                        });

                        setTimeout(function(){  window.location = '{{route('daily_load.transport')}}'; }, 1000);


                    }





                    // $("#ajaxResponse").append("<div>"+msg+"</div>");
                }
            });


            //alert(link_sent);
        }



    </script>

@endsection
