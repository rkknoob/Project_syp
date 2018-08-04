@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">เอกสารแจ้งเตือน</li>
        </ul>
    </div><!-- breadcrumb -->

<br>
    <div class="container">
    <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('doc_warning.index')}}">
        {{ csrf_field() }}
        <div class="panel panel-danger " >
            <div class="panel-heading">
                <h4> <i class="fa fa-search " ></i> ค้นหารายชื่อ</h4>
            </div>


            <div class="panel-body">

                <div class="form-group">


                    <label for="depart_no" class="col-md-2 control-label">User ID : </label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="txtname" id="txtname" value="{{ old('id') }}"required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success" id="submit_id">ค้นหารายชื่อ</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-danger" >
            <div class="panel-heading">
                <h4> <i class="fa fa-address-card "></i> ข้อมูลพนักงาน</h4>
            </div>

            <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ลำดับเอกสาร</th>
                <th>รหัสพนักงาน</th>
                <th>ชื่อพนักงาน</th>
                <th>ประเภท</th>

                <th>ลักษณะใบเตือน</th>
                <th>เวลาที่บันทึก</th>
                <th>ผู้ที่บันทึก</th>
                <th>เลือก</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr data-tr="{{$user->No}}">
                    <td>{{$user->No}}</td>
                    <td>{{$user->user_code}}</td>
                    <td>{{$user->fname}}  {{$user->lname}}</td>

                    <td>{{$user->mistake_code}} : {{$user->description_mistake}}</td>

                    <td><?php
                        if ($user->D_Devo == 9){
                            echo "V";


                        }else if($user->D_Devo == 10){
                            echo "W";

                        }else if($user->D_Devo == 11){

                            echo "TM";
                        }


                        ?></td>

                    <td>{{$user->user_date}}</td>
                    <td>{{$user->user_login}}</td>
                    <td>

                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" onclick="att_data('<?php echo $user->No;?>')">End Process</button>


                        <a href="" class="btn btn-warning btn-xs">
                            Print Document
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
                    <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label> แจ้งเตือน คุณต้องการจบงานใช้หรือไหม่?</h4>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">

                            <input type="hidden" id="no_x">

                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  onclick="save_data()">ตกลง</button>
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

                "bJQueryUI": true,
                "sPaginationType": "full_numbers"

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


        function att_data(xx)
        {
            // alert(xx);
            $("#no_x").val(xx);

        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //บันทึกค่าที่เลือก  save data
        function save_data() {


            var no=$('#no_x').val();


            $.ajax({
                type: 'get',
                url:  '/doc_warning/update_doc/',
                data: {no:no
                },
                success: function( msg ) {

                    if(msg.trim()=='1'){
                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');
                        swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {
                            button: false,
                        });
                        setTimeout(function(){  window.location = '{{route('doc_warning.index')}}'; }, 2000);

                    }





                    // $("#ajaxResponse").append("<div>"+msg+"</div>");
                }
            });


            //alert(link_sent);
        }

    </script>

@endsection
