<?php
    $array_status = array("1"=>'admin',"2"=>'ship',"3"=>'transport',"4"=>'pbs');
?>

@extends('layouts.endless')

@section('content')



    <style>
        .text_size{
            font-size: 25px;
        }

        .nsme_user{
            text-align: center;
        }

        hr{
            width: 80%;
        }


        .div_text{
            width: 80%;
            margin: auto;

        }

        .div_text2{
            width: 80%;
            margin: auto;
            text-align:center;
        }


        .div1 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }
        .div2 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }
        .div3 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }


        .div_modal{
            width: 80%;
            margin: auto;
            text-align:center;
        }

    </style>
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ตั้งค่าผู้ใช้งาน </li>
        </ul>
    </div><!-- breadcrumb -->
<br>
    <div class="container">


        <div class="col-md-14">
        <div class="panel panel-success">
            <div class="panel-heading"><h4>User Login Setting</h4></div>

            <div class="panel-body">
                <div class="no-margin" method="POST" action="#">

                    <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">User Code</label>
                                <input id="user_code" type="text" class="form-control" name="user_code" value="{{ old('user_code') }}" maxlength="8" required autofocus>

                            </div><!-- /form-group -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Comfrm Password</label>
                                <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation" required>
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">department</label>

                                    <select class="form-control" name="department" id="department">
                                        @foreach($department as $department2)
                                            <option value="{{$department2->department}}">{{$department2->department}}</option>
                                        @endforeach
                                    </select>



                            </div><!-- /form-group -->
                        </div><!-- /.col -->

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">status</label>
                                <select name="status" id="status" class="form-control ">
                                    <option value="Y" selected>ทำงาน</option>
                                    <option value="N">ลาออก</option>

                                </select>                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">level</label>
                                <select name="level"  id="level"class="form-control ">
                                    <option selected>1</option>
                                    <option>2</option>
                                    <option>3</option>

                                </select>                            </div><!-- /form-group -->
                        </div><!-- /.col -->

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">วันที่เริ่มงาน</label>
                                <input id="work_dat" type="text"  class="datepicker form-control"  name="work_dat" value="">

                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">รหัสพนักงาน</label>
                                <input id="code_id" type="text" class="form-control" name="code_id" value="" >

                            </div><!-- /.col -->
                        </div><!-- /.row -->






                    </div><!-- /.row -->




                </div>
            </div>
        </div>

            <div class="panel panel-success">
                <div class="panel-heading">
                    Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">นาม</label>
                                <select name="name_et" id="name_et" class="form-control ">
                                    <option selected>นาย</option>
                                    <option>นาง</option>
                                    <option>นางสาว</option>

                                </select>
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">ชื่อ</label>
                                <input type="text" placeholder="ชื่อภาษาไทย" class="form-control input-sm" id="fname" name="fname" data-required="true" data-minlength="8">

                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">นามสกุล</label>
                                <input type="text" placeholder="นามสกุลภาษาไทย" class="form-control input-sm" id="lname" name="lname" data-required="true" data-minlength="8">
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <select name="name_e" id="name_e" class="form-control ">
                                    <option selected>Mr</option>
                                    <option>Mrs</option>
                                    <option>Miss</option>

                                </select>
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">First name</label>
                                <input type="text" placeholder="In Put First name" class="form-control input-sm" id="fname_e" name="fname_e" data-required="true" data-minlength="8">

                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Last names</label>
                                <input type="text" placeholder="In Put Last name" class="form-control input-sm" id="lname_e" name="lname_e" data-required="true" data-minlength="8">
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="panel-footer" id="footer">
                                <button type="button" class="btn btn-success"  onclick="att_data()">บันทึกข้อมูล</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!-- /panel -->



        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อล็อคอิน</th>
                <th>ชื่อพนักงาน</th>
                <th>นามสกุลพนักงาน</th>
                <th>แผนก</th>
                <th>เลือก</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr data-tr="{{$user->id}}">
                    <td>{{$user->id}}</td>
                    <td>{{$user->user_code}}</td>

                    <td>{{$user->fname}}</td>
                    <td>{{$user->lname}}</td>
                    <td>{{$user->department}}</td>





                    </th>

                    <th>
                        <a href="{{Route('user_login.update',$user->id)}}" class="btn btn-warning btn-xs">
                            แก้ไข
                        </a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>



    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ผู้กะทำความผิดเซ็นรับทราบ</h4>
                </div>
                <div class="modal-body">



                    <div class='div_modal'>
                        <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">
                            <canvas id="signature-pad" class="signature-pad" width=200 height=400></canvas>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  id="save" class="btn btn-default" data-dismiss="modal">Save</button>
                    <button type="button"  id="clear" class="btn btn-default" data-dismiss="modal">Clear</button>
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


        function att_data()
        {



                if($("#user_code").val()== '') {

                    $("#user_code").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ user_code",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#user_code').focus();
                    return false;
                }

                 if($("#department").val()== '') {

                     $("#department").popover({
                         title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                         content : "กรุณาระบุ department",
                         html: true,
                         placement: 'top',
                         trigger: 'focus'
                     });
                     $('#department').focus();
                     return false;
            }  if($("#password").val()== ''){
            //alert();


            $("#password").popover({
                title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                content : "กรุณาระบุ Password",
                html: true,
                placement: 'top',
                trigger: 'focus'
            });
            $('#password').focus();
            return false;

        }  if($("#code_id").val()== ''){
            //alert();


            $("#code_id").popover({
                title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                content : "กรุณาระบุ รหัสพนักงาน",
                html: true,
                placement: 'top',
                trigger: 'focus'
            });
            $('#code_id').focus();
            return false;
        } if($("#fname").val()== ''){
            //alert();


            $("#fname").popover({
                title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                content : "กรุณาระบุ ชื่อ",
                html: true,
                placement: 'top',
                trigger: 'focus'
            });
            $('#fname').focus();
            return false;
        }   if($("#lname").val()== ''){
            //alert();


            $("#lname").popover({
                title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                content : "กรุณาระบุ นามสกุล",
                html: true,
                placement: 'top',
                trigger: 'focus'
            });
            $('#lname').focus();
            return false;
        } if($("#password").val() != $("#passwordconfirm").val()){
            swal(
                'แจ้งเตือน',
                'กรุณากรอก password ให้ตรงกัน' ,
                'error'
            )
            return false;
        }









            $('#myModal').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');

        //   var message_pri = $(".message_pri:checked").val();



        var color = "#FF0000";


        saveButton.addEventListener('click', function (event) {

            var data = signaturePad.toDataURL('image/png');

            var user_code=$('#user_code').val();

            var password=$('#password').val();
            var department=$('#department').val();

            var status=$('#status').val();
            var level=$('#level').val();
            var fname_e=$('#fname_e').val();
            var lname_e=$('#lname_e').val();
            var name_e=$('#name_e').val();
            var name_et=$('#name_et').val();
            var fname=$('#fname').val();
            var lname=$('#lname').val();
            var code_id=$('#code_id').val();
            var work_dat=$('#work_dat').val();
            var passwordconfirm = $('#passwordconfirm').val();


            if (signaturePad.isEmpty()) {
                return alert("Please provide a signature first.");
            }

            $.ajax({

                url:  '/user_login/create',
                data: {signatures:data,user_code:user_code,password:password,department:department,status:status,level:level,fname_e:fname_e,lname_e:lname_e,name_e:name_e,name_et:name_et,fname:fname,lname:lname,code_id:code_id,work_dat:work_dat},                    method: 'post',
                method: 'post',

                    success : function(msg){

                        if(msg.trim()=='1'){
                            //swal('บันทึกข้อมูลเสร็จเรียบร้อย');

                            swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {


                                button: false,
                            });
                            setTimeout(function(){  window.location = '{{route('user_login.index')}}'; }, 2000);


                        }else if(msg.trim()=='3'){


                            swal('แจ้งเตือน', 'ไม่เจอ Trip ID นี้' , 'error', {
                                button: false,
                            });
                            //     setTimeout(function(){  window.location = ''; }, 1000);
                        }else if(msg.trim()=='2'){
                            swal('แจ้งเตือน', 'User นี้ถูกเปิดใช้งานไปแล้ว' , 'error', {

                                button: false,

                            });
                            setTimeout(function(){  window.location = '{{route('user_login.index')}}'; }, 2000);
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


                }
            );

        });

        jQuery(function ($) {
            $.mask.definitions['~'] = '[+-]';






        });




        $('#work_dat').datepicker({
            format: "yyyy-mm-dd",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true});


        // Send data to server instead...


        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
        });





    </script>

@endsection
