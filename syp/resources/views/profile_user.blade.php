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

            width:300px;
            height:400px;
            margin: auto;
            text-align:center;
        }

        .wrapper {
            position: relative;

            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        img {
            position: absolute;
            left: 0;
            top: 0;
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
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">User Code</label>
                                    <input id="user_code" type="text" class="form-control" name="user_code" value="{{$user->user_code}}"disabled maxlength="8" required autofocus>

                                </div><!-- /form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required maxlength="8">
                                </div><!-- /form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Comfrm Password</label>
                                    <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation" required maxlength="8">
                                </div><!-- /form-group -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">











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
                                    <option {{old('job_status',$user->name_et)=="นาย"? 'selected':''}} value="นาย">นาย</option>
                                    <option {{old('job_status',$user->name_et)=="นาง"? 'selected':''}} value="นาง">นาง</option>
                                    <option {{old('job_status',$user->name_et)=="นางสาว"? 'selected':''}} value="นางสาว">นางสาว</option>

                                </select>
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">ชื่อ</label>
                                <input type="text" placeholder="ชื่อภาษาไทย" class="form-control input-sm" id="fname" name="fname" data-required="true" data-minlength="8"  value="{{$user->fname}}" >

                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">นามสกุล</label>
                                <input type="text" placeholder="นามสกุลภาษาไทย" class="form-control input-sm" id="lname" name="lname" data-required="true" data-minlength="8" value="{{$user->lname}}" >
                            </div><!-- /form-group -->
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <select name="name_e" id="name_e" class="form-control ">
                                    <option {{old('job_status',$user->name_e)=="Mr"? 'selected':''}} value="Mr">Mr</option>
                                    <option {{old('job_status',$user->name_e)=="Mrs"? 'selected':''}} value="Mrs">Mrs</option>
                                    <option {{old('job_status',$user->name_e)=="Miss"? 'selected':''}} value="Miss">Miss</option>

                                </select>
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">First name</label>
                                <input type="text" placeholder="In Put First name" class="form-control input-sm" id="fname_e" name="fname_e" data-required="true" data-minlength="8" value="{{$user->fname_e}}">

                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Last names</label>

                                <input type="text" placeholder="In Put Last name" class="form-control input-sm" id="lname_e" name="lname_e" data-required="true" data-minlength="8" value="{{$user->lname_e}}">
                            </div><!-- /form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="form-group">

                        <div class="footer" id="footer">
                            <button type="button" class="btn btn-info btn-lg"  onclick="att_data()">บันทึกข้อมูล</button>
                        </div>

                    </div>

                </div>
            </div><!-- /panel -->



        </div>



    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ยืนยันลายเซ็นต์</h4>
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

                    url : '/profile/updated',
                    type: 'POST',
                    data: {user_code:user_code,password:password,signatures:data,fname_e:fname_e,lname_e:lname_e,name_e:name_e,name_et:name_et,fname:fname,lname:lname},



                    success : function(data){


                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');


                        swal("Complete!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {


                            button: false,
                        });
                        setTimeout(function(){  window.location = '{{route('home')}}'; }, 1000);
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
            document.getElementById("suggestion").value = '';
        });

        cancelButton2.addEventListener('click', function (event) {
            signaturePad.clear();
            document.getElementById("suggestion").value = '';
        });







    </script>

@endsection
