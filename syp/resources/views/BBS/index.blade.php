@extends('layouts.endless2')

@section('content')
    <style>


        .panel-body{
            border-bottom: 1px solid #f1f5fc;
        }








    </style>


    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">BBS Card</li>
        </ul>
    </div><!-- breadcrumb -->



    <div class="panel panel-default">
        <form id="formWizard1" novalidate>
            <div class="panel-heading">
                ใบบันทึก การสังเกตุพฤติกรรม

            </div>
            <div class="panel-tab">
                <ul class="wizard-steps wizard-demo" id="wizardDemo1">
                    <li class="active">
                        <a href="#wizardContent1" data-toggle="tab">Step 1</a>
                    </li>
                    <li>
                        <a href="#wizardContent2" data-toggle="tab">Step 2</a>
                    </li>

                </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="wizardContent1">
                        <div class="container">
                            <div class="panel panel-danger" >
                                <div class="panel-heading">
                                    <h4> <i class="fa fa-pencil-square-o" ></i>แนวทางการสังเกตุพฤติกรรม</h4>
                                </div>


                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6"><i class="glyphicon glyphicon-arrow-right">&nbsp;ชี้ผลกระทบจากพฤติกรรมที่ไม่ปลอดภัย</i></label>

                                    </div><!-- /form-group -->
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6"><i class="glyphicon glyphicon-arrow-right">&nbsp;หารือถึงการปรับปรุงให้ปลอดภัยขึ้น</i></label>
                                    </div><!-- /form-group -->
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6"><i class="glyphicon glyphicon-arrow-right">&nbsp;ขอคำยืนยันว่าจะทำงานอย่างปลอดภัย ตามที่หารือกัน</i></label>
                                    </div><!-- /form-group -->
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6"><i class="glyphicon glyphicon-arrow-right">&nbsp;กล่าวขอบคุณ ผู้ถูกสังเกตุ</i></label>
                                    </div><!-- /form-group -->
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="depart_no" class="col-md-2 control-label">User ID : </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="user_bbs" id="user_bbs" value="{{ old('id') }}" maxlength ="8" required>
                                        </div>

                                    </div><!-- /form-group -->
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="wizardContent2">
                        <div class="container">
                            <div class="panel panel-danger" >
                                <div class="panel-heading">

                                    <h4> <i class="fa fa-pencil-square-o" ></i>พฤติกรรมที่ตรวจ</h4>
                                </div>


                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6">1.หยุดรถบริเวณทางแยก / เข้าออกซอย / มุมอับสายตา</label>
                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S1" id="S1" value="Y" checked required>
                                            <span class="custom-radio"></span>
                                            ปลอดภัย
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S1" id="S1" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่ปลอดภัยปลอดภัย
                                        </label>
                                    </div><!-- /form-group -->

                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6">2.พนักงานหันมอง ด้านซ้าย ด้านขวา ด้านหลัง และให้สัญญาณแตร ก่อนขันเคลื่อนรถ</label>
                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S2"  id="S2" value="Y" checked required>
                                            <span class="custom-radio"></span>
                                            ปลอดภัย
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S2" id="S2" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่ปลอดภัยปลอดภัย
                                        </label>
                                    </div><!-- /form-group -->
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6">3.เว้นระยะห่างระหว่างคัน (ระยะปลอดภัยคือ ประมาณ 2 ช่วงคัน)</label>
                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S3"  id="S3" value="Y" checked required>
                                            <span class="custom-radio"></span>
                                            ปลอดภัย
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S3" id="S3" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่ปลอดภัยปลอดภัย
                                        </label>
                                    </div><!-- /form-group -->
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6">4.ใช้เทปใส(OPP)รัดยึดพาเลทสินค้า / พันฟิล์มสินค้าทั้งพาเลทอย่างแน่นหนา</label>
                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S4" id="S4" value="Y" checked required>
                                            <span class="custom-radio"></span>
                                            ปลอดภัย
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S4" id="S4" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่ปลอดภัยปลอดภัย
                                        </label>
                                    </div><!-- /form-group -->
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6">5.เก็บเศษไม้พาเลทแตก/พลาสติกตามพื้น</label>
                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S5" id="S5" value="Y" checked required>
                                            <span class="custom-radio"></span>
                                            ปลอดภัย
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S5" id="S5" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่ปลอดภัยปลอดภัย
                                        </label>
                                    </div><!-- /form-group -->
                                </div>


                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">6.อื่นๆ</label>
                                        <div class="control-label col-lg-3">
                                            <input id="etc" type="text" class="form-control" name="etc" value="">
                                        </div>
                                        <label class="control-label col-lg-2 ">
                                            <input type="radio" name="S6" id="S6" value="Y">
                                            <span class="custom-radio"></span>
                                            ปลอดภัย
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S6" id="S6" value="N">
                                            <span class="custom-radio"></span>
                                            ไม่ปลอดภัยปลอดภัย
                                        </label>
                                    </div><!-- /form-group -->
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-6">7.ตรวจเช็คสภาพรถหรือไม่</label>

                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S7"  id="S7" value="Y"  checked required>
                                            <span class="custom-radio"></span>
                                            ตรวจ
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S7" id="S7" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่ตรวจ
                                        </label>
                                    </div><!-- /form-group -->

                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">8.สุ่มตรวจใบขับขี่</label>
                                        <div class="control-label col-lg-3">
                                            <input id="drive" type="text" class="form-control" name="drive" value="">
                                        </div>
                                        <label class="control-label col-lg-2">
                                            <input type="radio" name="S8"  id="S8" value="Y"  checked required>
                                            <span class="custom-radio"></span>
                                            มีใบขับขี่
                                        </label>
                                        <label class="label-checkbox inline ">
                                            <input type="radio" name="S8" id="S8" value="N" required>
                                            <span class="custom-radio"></span>
                                            ไม่มีใบขับขี่
                                        </label>
                                    </div><!-- /form-group -->

                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="footer" id="footer">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">บันทึกข้อมูล</button>
                                        </div>
                                    </div><!-- /form-group -->
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-left">
                    <button class="btn btn-success btn-sm disabled" id="prevStep1" >Previous</button>
                    <button type="submit" class="btn btn-sm btn-success" id="nextStep1" >Next</button>
                </div>

                <div class="pull-right" style="width:30%">
                    <div class="progress progress-striped active m-top-sm m-bottom-none">
                        <div class="progress-bar progress-bar-success" id="wizardProgress" style="width:33%;">
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div><!-- /panel -->



    <div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="clear2" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ผู้ถูกสำรวจ BBS เซ็นรับทราบ</h4>
                </div>
                <div class="modal-body">

                    <div class='div_modal'>
                        <div class="wrapper">
                            <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  id="save" class="btn btn-default" data-dismiss="modal" >Save</button>
                    <button id="clear" class="btn btn-default" >Clear</button>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('javascript')

    <script>

        $(function	()	{

            //Form Wizard 1
            var currentStep_1 = 1;

            //Form Wizard 2
            var currentStep_2 = 1;

            $('.wizard-demo li a').click(function()	{
                alert('You must enter your information')
                return false;
            });






            $('#formWizard1').parsley( { listeners: {
                onFieldValidate: function ( elem ) {
                    // if field is not visible, do not apply Parsley validation!
                    if ( !$( elem ).is( ':visible' ) ) {
                        return true;
                    }

                    return false;
                },
                onFormSubmit: function ( isFormValid, event ) {
                    if(isFormValid)	{

                        currentStep_1++;

                        if(currentStep_1 = 0)	{

                            $('#wizardDemo1 li:eq(1) a').tab('show');
                            $('#wizardProgress').css("width","100%");

                            $('#prevStep1').attr('disabled',false);
                            $('#prevStep1').removeClass('disabled');
                            $('#nextStep1').hide();
                            $('#prevStep1').hide();
                        }
                        else if (currentStep_1 = 1) {
                            $('#wizardDemo1 li:eq(1) a').tab('show');
                            $('#wizardProgress').css("width","100%");

                            $('#prevStep1').attr('disabled',false);
                            $('#prevStep1').removeClass('disabled');
                            $('#nextStep1').hide();


                        }else if (currentStep_1 = 2) {

                            $('#wizardDemo1 li:eq(1) a').tab('show');
                            $('#wizardProgress').css("width","100%");

                            $('#prevStep1').attr('disabled',false);
                            $('#prevStep1').removeClass('disabled');
                        }else {

                            alert(currentStep_1);
                        }

                        return false;
                    }
                }
            }});


            $('#prevStep1').click(function()	{

                currentStep_1--;


                if(currentStep_1 = 1)	{

                    $('#wizardDemo1 li:eq(0) a').tab('show');
                    $('#wizardProgress').css("width","100%");

                    $('#prevStep1').attr('disabled',true);
                    $('#prevStep1').addClass('disabled');

                    $('#nextStep1').show();

                    $('#wizardProgress').css("width","33%");
                }
                else if(currentStep_1 = 2)	{

                    $('#wizardDemo1 li:eq(1) a').tab('show');
                    $('#wizardProgress').css("width","100%");

                    $('#nextStep1').attr('disabled',false);
                    $('#nextStep1').removeClass('disabled');


                    $('#wizardProgress').css("width","100%");
                }

                return false;
            });


        });





        $('#user_bbs').bind('keyup', function(e){

            if ($(this).val().length == 8){

                $('#nextStep1').delay(200).submit();

            }

        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            minWidth: 0.1,
            maxWidth: 1,
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');
        var cancelButton2 = document.getElementById('clear2');

        saveButton.addEventListener('click', function (event) {


            if (signaturePad.isEmpty()) {
                return alert("Please provide a signature first.");
            }


            var safaty_1=$('input[name=S1]:checked').val();


            var safaty_2=$('input[name=S2]:checked').val();
            var safaty_3=$('input[name=S3]:checked').val();
            var safaty_4=$('input[name=S4]:checked').val();
            var safaty_5=$('input[name=S5]:checked').val();
            var safaty_6=$('input[name=S6]:checked').val();
            var safaty_7=$('input[name=S7]:checked').val();
            var safaty_8=$('input[name=S8]:checked').val();
            var user_bbs=$('#user_bbs').val();
            var etc=$('#etc').val();
            var drive=$('#drive').val();



            $.ajax({
                    type:'POST',
                    url : '/BBS/index/create',
                    data: {safaty_1:safaty_1,safaty_2:safaty_2,safaty_3:safaty_3,safaty_4:safaty_4,safaty_5:safaty_5,safaty_6:safaty_6,safaty_7:safaty_7,safaty_8:safaty_8,user_bbs:user_bbs,etc:etc,drive:drive},

                    success : function(data){
                        swal("Complete!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {
                            button: false,
                        });
                        setTimeout(function(){  window.location = '{{route('home')}}'; }, 1000);
                    }
                }
            );

        });


        // Send data to server instead...


        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
            document.getElementById("suggestion").value = '';
        });


        $('#clear').off('click').on('click',function(){
            signaturePad.clear();
        });

        cancelButton2.addEventListener('click', function (event) {
            signaturePad.clear();
            document.getElementById("suggestion").value = '';
        });









    </script>

@endsection
