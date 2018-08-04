@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">เพิ่มประเภทความผิด</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>
    @foreach($items as $items2)
    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="myform" method="POST"  action="{{route('typemistakeedit.updated',$items2->mistake_code)}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> เพิ่มประเภทความผิด</h4>
                </div>

                @include('sweet::alert')
                <div class="panel-body">

                    <div class="form-group">



                        <label for="depart_no" class="col-md-2 control-label">ประเภทความผิด : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="mistake_code" id="mistake_code" value="{{$items2->mistake_code}}" maxlength ="2" readonly>
                        </div>
                    </div>

                    <div class="form-group">

                            <label for="depart_no" class="col-md-2 control-label">ระดับ : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cnt_alert" id="cnt_alert" value="{{$items2->cnt_alert}}" maxlength ="1" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="depart_no" class="col-md-2 control-label">แผนก : </label>
                        <div class="col-md-3">
                            <select class="form-control" name="group_department" id="group_department">

                                    <option {{old('group_department',$items2->group_department)=="All"? 'selected':''}} value="All">All</option>
                                <option {{old('group_department',$items2->group_department)=="System"? 'selected':''}} value="System">System</option>
                                <option {{old('group_department',$items2->group_department)=="Trunking"? 'selected':''}} value="Trunking">Trunking</option>
                                <option {{old('group_department',$items2->group_department)=="Inventory"? 'selected':''}} value="Inventory">Inventory</option>
                                <option {{old('group_department',$items2->group_department)=="Inbound"? 'selected':''}} value="Inbound">Inbound</option>
                                <option {{old('group_department',$items2->group_department)=="CS"? 'selected':''}} value="CS">CS</option>
                                <option {{old('group_department',$items2->group_department)=="Audit Equipment"? 'selected':''}} value="Audit Equipment">Audit Equipment</option>
                                <option {{old('group_department',$items2->group_department)=="LPS"? 'selected':''}} value="LPS">LPS</option>
                                <option {{old('group_department',$items2->group_department)=="Safety"? 'selected':''}} value="Safety">Safety</option>
                                <option {{old('group_department',$items2->group_department)=="FM"? 'selected':''}} value="FM">FM</option>
                                <option {{old('group_department',$items2->group_department)=="Receiving"? 'selected':''}} value="Receiving">Receiving</option>
                                <option {{old('group_department',$items2->group_department)=="FLT Operation"? 'selected':''}} value="FLT Operation">FLT Operation</option>
                                <option {{old('group_department',$items2->group_department)=="Picking Ambient"? 'selected':''}} value="Picking Ambient">Picking Ambient</option>
                                <option {{old('group_department',$items2->group_department)=="Shipping"? 'selected':''}} value="Shipping">Shipping</option>
                                <option {{old('group_department',$items2->group_department)=="HR"? 'selected':''}} value="HR">HR</option>
                                <option {{old('group_department',$items2->group_department)=="Planning & Performance"? 'selected':''}} value="Planning & Performance">Planning & Performance</option>
                                <option {{old('group_department',$items2->group_department)=="BOL Audit"? 'selected':''}} value="BOL Audit">BOL Audit</option>
                                <option {{old('group_department',$items2->group_department)=="Transport"? 'selected':''}} value="Transport">Transport</option>




                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="depart_no" class="col-md-2 control-label">หัวข้อ : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="description_mistake" id="description_mistake" value="{{$items2->description_mistake}}"required >
                        </div>


                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">บันทึกข้อมูล</button>
                        </div>
                    </div>


                 </div>


            </div>
            @endforeach










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
