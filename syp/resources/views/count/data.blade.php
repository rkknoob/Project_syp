@extends('layouts.bbscard1')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">เพิ่ม location</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>


    <div class="container">

            {{ csrf_field() }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> เพิ่มข้อมูล Round 2</h4>
                </div>

                @include('sweet::alert')
                <div class="panel-body">

                    <div class="form-group">

                        <label for="depart_no" class="col-md-2 control-label">Location :</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="location" id="location" value="{{ old('id') }}" maxlength ="9" >
                        </div>


                            <button type="button" class="btn btn-success" onclick="save_data()">บันทึกข้อมูล</button>

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
                "sPaginationType": "full_numbers",
                responsive: true


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


        function save_data() {


            var location=$('#location').val();


            if($("#location").val()== '') {

                $("#location").popover({
                    title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                    content : "ระบุ Locaction ด้วย",
                    html: true,
                    placement: 'top',
                    trigger: 'focus'
                });
                $('#location').focus();
                return false;
            }







            $.ajax({
                type: 'get',
                url:  '/count/update/data/',
                data: {location:location},
                success: function(msg) {

                    if(msg.trim()=='1'){
                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');
                        document.getElementById("type-constraint").reset();
                        swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success", {


                            button: false,
                        });



                    }else if(msg.trim()=='2'){
                        alert('เคยใส่ไปแล้ว');
                        //   setTimeout(function(){  window.location = ''; }, 2000);
                    }
                }
            });


            //alert(link_sent);
        }







    </script>

@endsection
