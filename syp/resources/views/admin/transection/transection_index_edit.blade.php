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
    @foreach ($data_trann as $data_trann2)


    <br>
    <div class="container">


            <form class="form-horizontal form-border no-margin"  id="myform" method="POST"  action="{{route('admin/transection.transection.update')}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}




            <div class="panel panel-danger" >
                <div class="panel-heading">

                    <h4> <i class="fa fa-pencil-square-o" ></i> เพิ่มข้อผิดพลาด</h4>
                </div>




                <div class="panel-body">
                    <div class="form-group">
                        <label for="depart_no" class="col-md-3 control-label">ข้อผิดพลาด :</label>

                        <div class="col-md-2">
                            <select name="mistake_code"  class="form-control" id="mistake_code"  onchange="showButton()"  required >

                                <option value="{{$data_trann2->mistake_code}}" disabled selected>{{ $data_trann2->mistake_code }} : {{ $data_trann2->description_mistake }}</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->mistake_code }}">{{ $item->mistake_code }} : {{ $item->description_mistake }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{ app('request')->input('coaching') }}
                        <div id="message" class="message"></div>
                        <label for="depart_no" class="col-md-2 control-label" hidden>รายละเอืยด :</label>
                        <div class="col-md-4">
                            <input type="hidden" class="form-control" name="description" id="description"required>
                            <input type="text" name="user_code" id="user_code1" value="{{$data_trann2->user_code}}">
                            <input type="hidden" name="No" id="No" value="{{$data_trann2->No}}">
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
                                <input type="radio" name="type_warning" value="2" id="Yes"  {{ $data_trann2->type_warning == '2' ? 'checked' : '' }} >

                                <span class="custom-radio"></span>
                                Devolop / Warning
                            </label>



                        </div>

                        @include('sweet::alert')

                        <div>

                            <label for="depart_no" class="col-md-1 control-label">ระดับ :</label>
                            <div class = "col-md-2">
                                <select name="D_devolop"  class="form-control {{ $errors->has('D_devolop') ? ' has-error' : '' }}" id="warn" onchange="showDiv(this)" required disabled>
                                    <option value="{{ $data_trann2->D_devolop }}" @if(old('D_devolop')&&old('D_devolop')== $data_trann2->D_devolop) selected='selected' @endif >


                                            @if ($data_trann2->D_devolop == 1)
                                               1:D1
                                            @elseif ($data_trann2->D_devolop == 2)
                                                2:D2
                                            @elseif ($data_trann2->D_devolop == 3)
                                               3:D3
                                        @elseif ($data_trann2->D_devolop == 4)
                                            4:D4
                                        @elseif ($data_trann2->D_devolop == 5)
                                            5:D5
                                        @elseif ($data_trann2->D_devolop == 6)
                                            6:D6
                                        @elseif ($data_trann2->D_devolop == 7)
                                            7:D7
                                        @elseif ($data_trann2->D_devolop == 8)
                                              8:D8
                                        @elseif ($data_trann2->D_devolop == 9)
                                               9:V
                                        @elseif ($data_trann2->D_devolop == 10)
                                               10:W
                                        @elseif ($data_trann2->D_devolop == 11)
                                               11:TM
                                        @else
                                            I don't have any records!
                                        @endif

                                    </option>
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

                            </div>
                        </div>

                    </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">รายละเอียด : </label>
                            <div class="col-md-3">
                                <textarea name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                    <div id="hidden_div2">
                        <div class="form-group">
                            <label class="col-md-3 control-label">ข้อผิดพลาดทีพบ : </label>
                            <div class="col-md-4">
                                <select name="mistake_type" class="form-control" id="review" required>
                                    <option value="{{$data_trann2->mistake_type}}">{{$data_trann2->mistake_description}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">แผนการปรังปรุงและพัฒนา : </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control input-sm" id="devolop_plan" name="devolop_plan" value="{{$data_trann2->devolop_plan}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">สถานะ : </label>
                            <div class="col-md-2">
                                <select name="flag_comfirm" id="flag_comfirm" class="form-control" >
                                    <option {{old('flag_comfirm',$data_trann2->flag_comfirm)=="Y"? 'selected':''}} value="Y">ยันยืนรายการนี้</option>
                                    <option {{old('flag_comfirm',$data_trann2->flag_comfirm)=="N"? 'selected':''}} value="N">ยกเลิกรายการนี้</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="panel-footer">
                    <button type="submit" class="btn btn-success" >ขั้นตอนต่อไป</button>


                        <a class="btn btn-primary" href="{{ URL::to('admin/transection/datamaster/index?user_code=' . $data_trann2->user_code)}}"> Back</a>

                </div>
            </div>

            @endforeach
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

                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>

                                </th>


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


                    $.each(data,function(index,value) {




                        $table.row.add( [
                            value.row.toString(),
                            value.fname.trim(),
                            value.mistake_code.trim(),
                            value.user_login.trim(),



                        ]).draw();

                    });

                },
                error: function(data){
                    alert("fail");
                }

            });







        }




        $("#Yes").click(function() {


        });


        $("#No").click(function() {

            // $("#warn").hide();//To hide the dropdown
        });

        $("#No2").click(function() {


        });

        function validateForm() {
            var type_warning = document.forms["type-constraint"]["type_warning"].value;
            var x = document.forms["type-constraint"]["D_devolop"].value;
            var path_picture = document.forms["type-constraint"]["path_picture"].value;


            var frm = document.getElementsByName('type-constraint')[0];
            frm.submit(); // Submit the form
            frm.reset();  // Reset all form data
            return false; // Prevent page refresh





            if ((type_warning = '2') && (x > 8)){

                if(path_picture =='') {

                    swal("กรุณาแนบรูปด้วยครับ!")
                    return false;

                }



            }


        }


        $(document).ready(function(){
            $('#warn').val('{{ $data_trann2->D_devolop }}');
        });








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

        jQuery(function ($) {
            $.mask.definitions['~'] = '[+-]';


            $("input[name$='date_review']").mask('9999_99_99');




        });



        $(document).ready(function() {

            if ( data['success'] )
            {
                alert(data['success']);
                location.reload();
            }

        });


        $('#mistake_code').on('change', function(e) {
            var mistake_code=$('#mistake_code').val();



            $.ajax({
                type :'get',
                url: "/devo/showalert",
                data: {mistake_code:mistake_code},


                success : function(data){



                    if(data == 0){


                        $('#message').html("กรุณาเลือกเป็น V, W, TM ");
                    }else if(data == 2){


                        $('#message').html("กรุณาเลือกเป็น D1, V, W, TM");


                    }else if (data == 4){

                        $('#message').html("กรุณาเลือกเป็น D1-D4, V, W, TM");

                    }


                    else {
                        $('#message').html("กรุณาเลือกเป็น D1-D8, V, W, TM");

                    }






                }

            });

        });




        // Send data to server instead...





    </script>




@endsection


