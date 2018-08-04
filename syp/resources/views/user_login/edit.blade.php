<?php
$array_status = array("1"=>'admin',"2"=>'ship',"3"=>'transport',"4"=>'pbs');
?>

@extends('layouts.endless')

@section('content')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ตั้งค่าผู้ใช้งาน </li>
        </ul>
    </div><!-- breadcrumb -->
    <br>
    <div class="container">
        {{ method_field('PUT')}}

        <div class="col-md-14">
            <div class="panel panel-success">
                <div class="panel-heading"><h4>User Login Setting</h4></div>

                <div class="panel-body">
                    <div class="no-margin"  action="#">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">User Code</label>
                                    <input id="user_code" type="text" class="form-control" name="user_code" value="{{$user->user_code}}" maxlength="8" required>

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


                                        <option {{old('group_department',$user->department)=="System"? 'selected':''}} value="System">System</option>
                                        <option {{old('group_department',$user->department)=="Trunking"? 'selected':''}} value="Trunking">Trunking</option>
                                        <option {{old('group_department',$user->department)=="Inventory"? 'selected':''}} value="Inventory">Inventory</option>
                                        <option {{old('group_department',$user->department)=="Inbound"? 'selected':''}} value="Inbound">Inbound</option>
                                        <option {{old('group_department',$user->department)=="CS"? 'selected':''}} value="CS">CS</option>
                                        <option {{old('group_department',$user->department)=="Audit Equipment"? 'selected':''}} value="Audit Equipment">Audit Equipment</option>
                                        <option {{old('group_department',$user->department)=="LPS"? 'selected':''}} value="LPS">LPS</option>
                                        <option {{old('group_department',$user->department)=="Safety"? 'selected':''}} value="Safety">Safety</option>
                                        <option {{old('group_department',$user->department)=="FM"? 'selected':''}} value="FM">FM</option>
                                        <option {{old('group_department',$user->department)=="Receiving"? 'selected':''}} value="Receiving">Receiving</option>
                                        <option {{old('group_department',$user->department)=="FLT Operation"? 'selected':''}} value="FLT Operation">FLT Operation</option>
                                        <option {{old('group_department',$user->department)=="Picking Ambient"? 'selected':''}} value="Picking Ambient">Picking Ambient</option>
                                        <option {{old('group_department',$user->department)=="Shipping"? 'selected':''}} value="Shipping">Shipping</option>
                                        <option {{old('group_department',$user->department)=="HR"? 'selected':''}} value="HR">HR</option>
                                        <option {{old('group_department',$user->department)=="Planning & Performance"? 'selected':''}} value="Planning & Performance">Planning & Performance</option>
                                        <option {{old('group_department',$user->department)=="BOL Audit"? 'selected':''}} value="BOL Audit">BOL Audit</option>
                                        <option {{old('group_department',$user->department)=="Transport"? 'selected':''}} value="Transport">Transport</option>
                                        <option {{old('group_department',$user->department)=="Picking Fresh"? 'selected':''}} value="Picking Fresh">Picking Fresh</option>




                                    </select>

                                </div><!-- /form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">status</label>
                                    <select name="status" id="status" class="form-control ">
                                        <option {{old('level',$user->status)=="Y"? 'selected':''}} value="Y">ทำงาน</option>
                                        <option {{old('level',$user->status)=="N"? 'selected':''}} value="N">ลาออก</option>

                                    </select>                            </div><!-- /form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">level</label>
                                    <select name="level"  id="level"class="form-control ">
                                        <option {{old('level',$user->level)=="1"? 'selected':''}} value="1">1</option>
                                        <option {{old('level',$user->level)=="2"? 'selected':''}} value="2">2</option>
                                        <option {{old('level',$user->level)=="3"? 'selected':''}} value="3">3</option>
                                    </select>                            </div><!-- /form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">วันที่เริ่มงาน</label>
                                    <input id="work_dat" type="text" class="datepicker form-control"  name="work_dat" value="{{$user->work_dat}}"  required >

                                </div><!-- /.col -->
                        </div><!-- /.row -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">รหัสพนักงาน</label>
                                    <input id="code_id" type="text" class="form-control" name="code_id" value="{{$user->code_id}}" required >

                                </div><!-- /.col -->
                            </div><!-- /.row -->


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Position</label>
                                    <input id="position" type="text" class="form-control" name="position" value="{{$user->position}}" required >

                                </div><!-- /form-group -->
                            </div><!-- /.col -->


                        </div>
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
                        </div><!-- /.col -->
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
                        <div class="col-md-6 col-md-offset-4">
                            <button type="button" id="submit_id" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div><!-- /panel -->



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

        $(document).ready(function() {
            $('#submit_id').on('click', function (e) {

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
                var position=$('#position').val();

                var passwordconfirm = $('#passwordconfirm').val();



                if(user_code==''){
                    //alert();


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

                if(password==''){
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
                }

                if(passwordconfirm==''){
                    //alert();


                    $("#passwordconfirm").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ passwordconfirm",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#passwordconfirm').focus();
                    return false;
                }

                if(fname==''){
                    //alert();


                    $("#fname").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ fname",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#fname').focus();
                    return false;
                }

                if(lname==''){
                    //alert();


                    $("#lname").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ lname",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#lname').focus();
                    return false;
                }

                if(department==''){
                    //alert();


                    $("#department").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ department",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#department').focus();
                    return false;
                }


                if(level =='' || level =='เลือก'){
                    //alert();


                    $("#level").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ Level",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#level').focus();
                    return false;
                }

                if(status =='' || status =='เลือก'){
                    //alert();


                    $("#status").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ status",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#status').focus();
                    return false;
                }


                if(name_et =='' || name_et =='เลือก'){
                    //alert();


                    $("#name_et").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ คำนาม",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#name_et').focus();
                    return false;
                }

                if(name_e =='' || name_e =='Choose'){
                    //alert();


                    $("#name_e").popover({
                        title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                        content : "กรุณาระบุ คำนาม",
                        html: true,
                        placement: 'top',
                        trigger: 'focus'
                    });
                    $('#name_e').focus();
                    return false;
                }

                if(password != passwordconfirm){
                    swal(
                        'แจ้งเตือน',
                        'กรุณากรอก password ให้ตรงกัน' ,
                        'error'
                    )
                    return false;
                }





                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                $.ajax({

                    url:  '/user_login/updated',
                    data: {user_code:user_code,password:password,department:department,status:status,level:level,fname_e:fname_e,lname_e:lname_e,name_e:name_e,name_et:name_et,fname:fname,lname:lname,code_id:code_id,work_dat:work_dat,position:position},
                    method: 'post',
                    success: function( msg ) {




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
                });
            });
        });

        $('#work_dat').datepicker({
            format: "yyyy-mm-dd",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true});


        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');

        saveButton.addEventListener('click', function (event) {
            var signatures = signaturePad.toDataURL('image/png');

// Send data to server instead...

        });

        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
        });

    </script>

@endsection
