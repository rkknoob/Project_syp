@extends('layouts.endless')

@section('content')
    <div class="container">
        <br>
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('coach.coach',$user_code)}}">
            {{ csrf_field() }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหาข้อมูล</h4>
                </div>

                <div class="panel-body">

                    <div class="form-group">

                        <label for="depart_no" class="col-md-2 control-label">เลือกประเภทการค้นหา : </label>
                        <div class="col-md-4">
                            <select name="mistake_code"  class="form-control" id="mistake_code">
                                <option value="" >เลือก</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->mistake_code }}">{{ $item->mistake_code }} : {{ $item->description_mistake }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="hidden" class="form-control" name="user_code" id="user_code" value="{{$user_code}}">
                        </div>

                    </div>


                    <div class="form-group ">

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">ค้นหาข้อมูล</button>
                        </div>


                    </div>
                </div>
            </div>






            <div class="panel panel-danger" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ประวัติสอนงาน</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ครั้งที่</th>
                                <th>ไอดี</th>
                                <th>ประเภท</th>
                                <th>ออกโดย</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $users)
                                <tr data-tr="{{$users->num}}">

                                    <td>{{$users->num}}</td>
                                    <td>{{$users->user_code}}</td>
                                    <td>{{$users->mistake_detail}}</td>
                                    <td>{{$users->user_login}}</td>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
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


            if(mistake_code == '01'||mistake_code == '02' ||mistake_code == '30'){


                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น V, W, TM</font>";

            }else if (mistake_code == '03'||mistake_code == '04'||mistake_code == '05'){
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1-D2, V, W, TM</font>";
                //   document.getElementById("message").innerHTML = "กรุณาเลือกเป็น D1, V, W, TM";

            }else if (mistake_code == '06'||mistake_code == '07'||mistake_code == '08'||mistake_code == '09'||mistake_code == '10'||mistake_code == '11'||mistake_code == '12'||mistake_code == '13'||mistake_code == '14'||mistake_code == '15'){
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1-D4, V, W, TM</font>";
                //   document.getElementById("message").innerHTML = "กรุณาเลือกเป็น D1-D4, V, W, TM";

            }else if(mistake_code == '16'||mistake_code == '17'){
                document.getElementById('message').innerHTML = "<font color="+color+">กรุณาเลือกระดับเป็น D1-D8, V, W, TM</font>";

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


