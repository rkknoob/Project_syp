@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">เพิ่มประเภทความผิด</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="myform" method="post" autocomplete="off" action="{{Route('typemistake.store')}}">
            {{ csrf_field() }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> เพิ่มประเภทความผิด</h4>
                </div>

                @include('sweet::alert')
                <div class="panel-body">

                    <div class="form-group">



                        <label for="depart_no" class="col-md-2 control-label">ประเภทความผิด : </label>
                        <div class="col-md-3">

                            <input type="text" class="form-control" name="mistake_code" id="mistake_code" value="{{ $mistakemax }}" maxlength ="2"readonly >

                        </div>
                    </div>
                    <div class="form-group">

                            <label for="depart_no" class="col-md-2 control-label">ระดับ : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cnt_alert" id="cnt_alert" value="{{ old('id') }}" maxlength ="1" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="depart_no" class="col-md-2 control-label">หัวข้อ : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="description_mistake" id="description_mistake" value="{{ old('id') }}"required >
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">บันทึกข้อมูล</button>
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
        jQuery(function ($) {
            $.mask.definitions['8']='[012345678]';

            $("input[name$='cnt_alert']").mask('9');
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
