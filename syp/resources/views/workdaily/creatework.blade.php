@extends('layouts.endless')

@section('content')


    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ออกแผนพัฒนา</li>
        </ul>
    </div><!-- breadcrumb -->

    <br>
    <div class="container">
        <form class="form-horizontal form-border no-margin"  autocomplete="off" name="type-constraint" id="type-constraint" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data" action="{{route('warning.store')}}">
            {{ csrf_field() }}

            <div class="panel panel-primary " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ข้อมูลพนักงาน</h4>
                </div>
                @foreach($data_user as $data_user2)


                    <div class="panel-body">

                        <div class="form-group">
                            <div class ="col-md-4">
                                <label for="depart_no" class="control-label">รหัสพนักงาน :</label>
                                <label for="depart_no" class="control-label">{{$data_user2->code_id}}</label>
                            </div>
                            <div class ="col-md-4">
                                <label for="depart_no" class="control-label">ชื่อพนักงาน :</label>
                                <label for="depart_no" class="control-label">{{$data_user2->fname}} {{$data_user2->lname}}</label>

                            </div>

                            <div class ="col-md-4">
                                <label for="depart_no" class="control-label">ชื่อ Log in :</label>
                                <label for="depart_no" class="control-label">{{$data_user2->user_code}}</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class ="col-md-2">
                                <label for="depart_no" class="control-label">แผนก/หน่วงงาน :</label>
                                <label for="depart_no" class="control-label" >{{$data_user2->department}}</label>
                            </div>
                            <div class ="col-md-3">
                                <label for="depart_no" class="control-label">ตำแหน่ง :</label>
                                <label for="depart_no" class="control-label" >{{$data_user2->position}}</label>
                            </div>
                            <div class ="col-md-3">
                                <label for="depart_no" class="control-label">วันที่เริ่มงาน :</label>
                                @foreach($time_working as $time_working2)
                                    <label for="depart_no" class="control-label"><?php
                                        if($data_user2->created_at !=''){
                                            $date_temp = date_create($data_user2->date_time_work);
                                            echo  date_format($date_temp, 'Y-m-d');
                                        }else{
                                            echo 'ไม่มีข้อมูล';
                                        }

                                        ?></label>
                                @endforeach
                            </div>
                            <div class ="col-md-3">
                                <label for="depart_no" class="control-label">อายุงาน :</label>
                                <label for="depart_no" class="control-label">{{$time_working2->year}} ปี {{$time_working2->month}} เดือน</label>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
            @if (Session::has('message'))

                <div class="alert alert-warning" data-dismiss="alert" aria-label="close" http-equiv="refresh">{{ Session::get('message') }}<meta http-equiv="refresh"></div>
                <meta http-equiv="refresh" content="3">
            @endif

            <div class="panel panel-primary" >
                <div class="panel-heading">

                    <h4> <i class="fa fa-pencil-square-o" ></i> เพิ่มข้อผิดพลาด</h4>
                </div>


                <div class="panel-body">
                    <div class="form-group">
                        <label for="depart_no" class="col-md-3 control-label">ข้อผิดพลาด :</label>

                        <div class="col-md-2">
                            <select name="mistake_code"  class="form-control" id="mistake_code"  onchange="showButton()"  required >
                                <option value="" disabled selected>เลือก</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->mistake_code }}">{{ $item->mistake_code }} : {{ $item->description_mistake }}</option>

                                @endforeach
                                <input type="hidden" name="coaching" id="coaching" value="0">
                            </select>
                        </div>

                        {{ app('request')->input('coaching') }}
                        <div id="message"></div>
                        <label for="depart_no" class="col-md-2 control-label" hidden>รายละเอืยด :</label>
                        <div class="col-md-4">
                            <input type="hidden" class="form-control" name="description" id="description"required>


                            <input type="hidden" name="user_code" id="user_code1" value="{{$user}}">
                            <input type="hidden" name="flag_print" id="flag_print" value="N">
                            <input type="hidden" name="flag_comfirm" id="flag_comfirm" value="N">


                            <input type="hidden" name="id_temp" id="id_temp" value="{{$id_temp}}">




                            <input type="hidden" name="user_login" id="user_login" value="{{Auth::user()->user_code}}">
                            <div id="one"></div>

                        </div>
                    </div>





                    <div class="form-group">
                        <label for="depart_no" class="col-md-3 control-label">เลือกประเภท :</label>
                        <div class="col-md-3">
                            <label class="label-radio inline">
                                <input type="radio" name="type_warning" value="1" id="No2" checked required>
                                <span class="custom-radio"></span>
                                Coaching
                            </label>

                            <label class="label-radio inline">
                                <input type="radio" name="type_warning" value="2" id="Yes">
                                <span class="custom-radio"></span>
                                Devolop / Warning
                            </label>



                        </div>

                        @include('sweet::alert')

                        <div>

                            <label for="depart_no" class="col-md-1 control-label">ระดับ :</label>
                            <div class = "col-md-2">
                                <select name="D_devolop"  class="form-control {{ $errors->has('D_devolop') ? ' has-error' : '' }}" id="warn" onchange="showDiv(this)" required disabled>
                                    <option value=""  disabled selected>เลือก</option>
                                    <option value="1">1 : D1</option>
                                    <option value="2">2 : D2</option>
                                    <option value="3">3 : D3</option>
                                    <option value="4">4 : D4</option>
                                    <option value="5">5 : D5</option>
                                    <option value="6">6 : D6</option>
                                    <option value="7">7 : D7</option>
                                    <option value="8">8 : D8</option>
                                    <option value="9">9 : V</option>
                                    <option value="10">10 : W</option>
                                    <option value="11">11 : TM</option>
                                </select>
                                @if ($errors->has('warning_status'))
                                    <span class="help-block">
            <strong>{{ $errors->first('warning_status') }}</strong>
        </span>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div id="hidden_div" hidden>
                        <div class="form-group">
                            <label class="col-md-3 control-label">รายละเอียด : </label>
                            <div class="col-md-3">
                                <textarea name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="hidden_div2">
                        <div class="form-group">
                            <label class="col-md-3 control-label">ข้อผิดพลาดทีพบ : </label>
                            <div class="col-md-4">
                                <select name="mistake_type" class="form-control" id="review" required>
                                    <option value="">เลือก</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">แผนการปรังปรุงและพัฒนา : </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control input-sm" id="devolop_plan" name="devolop_plan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">ระยะเวลา : </label>
                            <div class="col-md-2">
                                <select name="timlength" class="form-control" >

                                    <option value="1">ทันที</option>
                                    <option value="2">1 วัน</option>
                                    <option value="3">3 วัน</option>
                                    <option value="4">5 วัน</option>
                                    <option value="5">1 สัปดาห์</option>

                                </select>
                            </div>
                            <label class="col-md-2 control-label">วันที่ทบทวน : </label>
                            <div class="col-md-2">
                                <input type="text"  class="datepicker form-control" id="document_date" name="date_review">

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">แนบหลักฐานข้อผิดพลาด : </label>
                        <div class="col-md-6">
                            <input type="file" name="path_picture" class="form-control" accept="image/*" class="filestyle" data-size="sm" data-buttonText="Find file" >

                        </div>
                    </div>
                </div>





                <div class="panel-footer">
                    <button type="submit" class="btn btn-success" >ขั้นตอนต่อไป</button>

                </div>
            </div>


            <div id="show"></div>
            <div class="panel panel-danger" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ประวัติข้อผิดพลาด</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table4">
                        <thead>
                        <tr>

                            <th>ข้อผิดพลาด</th>
                            <th>แผน</th>
                            <th>ผู้ออกใบบันทึก</th>
                            <th>วันที่บันทึกข้อผิดพลาด</th>

                            <th>ครบรอบ</th>



                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>


        </form>

        <div id="coach"  class="panel-footer" >
            <button onclick="myFunction()" class="btn btn-success" formtarget="_blank">ประวัติ Coaching</button>

            </a>
        </div>
    </div>




    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label> กรุณาตรวจสอบความถูกต้องอีกครั้ง ?</h4>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_pb">
                            <thead>
                            <tr>
                                <th>ครั้งที่</th>
                                <th>ชื่อ- สกุล</th>
                                <th>ประเภท</th>
                                <th>ออกโดย</th>


                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal" onclick="save_data()">ตกลง</button>-->

                    {!! Form::submit('ตกลง',['class'=>'btn btn-default']) !!}


                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>



            </div>

        </div>
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



        function onDelete (id) {

            var result = confirm("Want to delete?");
            if (result) {
                //Logic to delete the item
                $.get('/user_login/delete/'+id,function (r) {

                    $('[data-tr='+id+']').remove();

                });
            }

        }


        function showButton(){
            var mistake_code=$('#mistake_code').val();
            var b = mistake_code ;

            document.getElementById("coaching").value = mistake_code;
            document.getElementById('coaching').style.display = "block";



        }


        function myFunction(){
            var mistake_code=$('#mistake_code').val();
            var user_code1=$('#user_code1').val();


            $('#myModal').modal('show');//now its working


            $.ajax({
                type :'get',
                url: "/ajax-subcat6",
                data: {mistake_code:mistake_code,user_code1:user_code1},
                datatype:'JSON',
                success : function(data){
                    var rrrow ='';
                    var $table = $('#table_pb').DataTable();

                    $table.clear().draw();
                    $.each(data,function(index,value) {

                        console.log(value)


                        $table.row.add( [
                            value.row.toString(),
                            value.fname.trim(),
                            value.mistake_code.trim(),
                            value.user_loginf.trim(),



                        ]).draw();

                    });

                },
                error: function(data){
                    alert("fail");
                }

            });







        }






        $("#Yes").click(function() {
            $("#warn").attr("disabled", false);

            $('#warn').prop('selectedIndex',0);
            document.getElementById('hidden_div2').style.display = "none";
        });


        $("#No").click(function() {
            $("#warn").attr("disabled", true);
            // $("#warn").hide();//To hide the dropdown
        });

        $("#No2").click(function() {
            $("#warn").attr("disabled", true);
            $('#warn').prop('selectedIndex',0);
            document.getElementById('hidden_div').style.display = "none";
            document.getElementById('hidden_div2').style.display = "block";

        });

        function validateForm() {
            var type_warning = document.forms["type-constraint"]["type_warning"].value;
            var x = document.forms["type-constraint"]["D_devolop"].value;
            var path_picture = document.forms["type-constraint"]["path_picture"].value;

            if ((type_warning = '2') && (x > 8)){

                if(path_picture =='') {

                    swal("กรุณาแนบรูปด้วยครับ!")
                    return false;

                }



            }


        }





        function showDiv(select){
            var warn=$('#warn').val();
            var type_warning = $("[name='type_warning']:checked").val();



            if(type_warning == 2){

                if(select.value > 1 || select.value < 8 ){
                    document.getElementById('hidden_div2').style.display = "block";
                    document.getElementById('hidden_div').style.display = "none";
                }

                if (select.value > 8){

                    document.getElementById('hidden_div').style.display = "block";
                    document.getElementById('hidden_div2').style.display = "none";
                }

            }else if(type_warning == 1) {


                document.getElementById('hidden_div2').style.display = "block";

            }








        }



        $("#mistake_code").change(function() {



            if($("#mistake_code").val().trim()=='30'){
                $('#No2').prop('checked' , false);
                $('#No').prop('checked' , false);
                $("#No2").attr("disabled", true);
                $("#No").attr("disabled", true);

            }else{
                $("#No2").attr("disabled", false);
                $("#No").attr("disabled", false);
            }
        });














        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        '<span style="color:#FF0000"> hi </span>';


        $('#mistake_code').on('change', function(e) {
            var mistake_code=$('#mistake_code').val();




            $.ajax({
                type :'get',
                url: "/ajax-subcat4",
                data: {mistake_code:mistake_code},
                datatype:'JSON',
                success: function(data) {
                    console.log(data);

                    $('#review').empty();
                    $.each(data, function(i, item) {

                        $('#review').append('<option value="'+ i +'">'+ data[i].mistake_description +'</option>');

                    })


                    /*$.each(data, function(key) {
                        alert(value);
                        //
                    });*/



                }


            });

        });






        $('#mistake_code').on('change', function(e) {
            var mistake_code=$('#mistake_code').val();
            var user_code=$('#user_code1').val();   // the dropdown item selected value


            $.ajax({
                type :'get',
                data: {mistake_code:mistake_code,user_code:user_code},
                url: "/ajax-subcat3",
                success : function(data){
                    //alert(data);

                    //
                    $('#show').html("สอนงานครั้งที่  "+ data);
                }

            });

        });


        $('#document_date').datepicker({
            format: "yyyy-mm-dd",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true});

        $('#mistake_code').on('change', function(e){
            var mistake_code=$('#mistake_code').val();
            var user_code=$('#user_code1').val();   // the dropdown item selected value
            var $table = $('#table4').DataTable();
            var color = "#FF0000";


            if(mistake_code == '01'||mistake_code == '02' ||mistake_code == '87'){


                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น V, W, TM</font>";

            }else if (mistake_code >= '03' && mistake_code <= '07'  || mistake_code == '48' || mistake_code == '88' ){
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1-D2, V, W, TM</font>";
                //   document.getElementById("message").innerHTML = "กรุณาเลือกเป็น D1, V, W, TM";

            }else if(mistake_code >= '14' && mistake_code <= '27' || mistake_code >= '29' && mistake_code <= '33' || mistake_code == '35' || mistake_code == '37' ||mistake_code >= '39' && mistake_code <= '44'||mistake_code >= '79' && mistake_code <= '86'||mistake_code >= '92' && mistake_code <= '101' ||mistake_code == '103' || mistake_code == '46'|| mistake_code == '47' || mistake_code == '50'|| mistake_code == '51'  || mistake_code >= '53' && mistake_code <= '56' || mistake_code >= '58' && mistake_code <= '62' || mistake_code == '64' || mistake_code >= '66' && mistake_code <= '70'){
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1-D8, V, W, TM</font>";

                //  document.getElementById("message").innerHTML = "กรุณาเลือกเป็น D1-D8, V, W, TM";

            }else if(mistake_code == '102'||mistake_code >= '08' && mistake_code <= '13' || mistake_code == '28' || mistake_code == '34' || mistake_code == '36' || mistake_code == '38'|| mistake_code == '49' || mistake_code == '52' || mistake_code == '57' || mistake_code == '63' || mistake_code == '65' || mistake_code == '71' ||mistake_code >= '89' && mistake_code <= '91'){
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1-D4, V, W, TM</font>";

                //  document.getElementById("message").innerHTML = "กรุณาเลือกเป็น D1-D8, V, W, TM";

            }


            else {
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1, V, W, TM</font>";
                //   document.getElementById("message").innerHTML = "กรุณาเลือกเป็น D1, V, W, TM";

            }






            $.ajax({
                type :'get',
                dataType:'json',
                data: {mistake_code:mistake_code,user_code:user_code},
                url: "/ajax-subcat",
                success : function(data){
                    console.log(data);
                    $table.clear().draw();
                    orderAddRow(data);

                }
            });

        });

        function orderAddRow($data) {

            var rrrow ='';
            var $table = $('#table4').DataTable();



            $.each($data,function(index,value) {



                $table.row.add( [

                    value.mistake_code +':'+ value.description_mistake,

                    value.D_devolop,
                    value.fname +' '+ value.lname,
                    value.user_date,

                    value.en_date_dev2,

                ]).draw();

            });








        }




        // Send data to server instead...





    </script>




@endsection


