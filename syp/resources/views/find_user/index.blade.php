@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">บันทึกความผิด</li>
        </ul>
    </div><!-- breadcrumb -->
<br>

    <div class="container">
    <form class="form-horizontal form-border no-margin"  id="myform" method="GET" autocomplete="off" action="{{Route('devo')}}">
        {{ csrf_field() }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหารายชื่อ</h4>
                </div>

                @include('sweet::alert')
            <div class="panel-body">

                <div class="form-group">


                        <input type="hidden" class="form-control" name="type_user" id="type_user" value="user_code_e"  required>

                    <label for="depart_no" class="col-md-2 control-label">User ID : </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="txtname" id="txtname" value="{{ old('id') }}" maxlength ="8" >

                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success" id="submit_id">ค้นหาข้อมูล</button>
                    </div>
                </div>
            </div>
            </div>
    </form>
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


        $('#txtname').bind('keyup', function(e){

            var txtname=$('#txtname').val();

            if ($(this).val().length == 8){

                $('#myform').delay(200).submit();

            }

        });


        $(document).ready(function() {
            $('#submit_id_d').on('click', function (e) {

                var user_code=$('#txtname').val();







                $.ajax({
                    type: 'post',
                    url:  '',
                    data: {user_code:id_1},
                    success: function( msg ) {
                        alert(msg);






                        // $("#ajaxResponse").append("<div>"+msg+"</div>");
                    }
                });
            });
        });




    </script>

@endsection
