@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">Datamaster</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="myform" method="GET" autocomplete="off" action="">
            {{ csrf_field() }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหารายชื่อ</h4>
                </div>

                @include('sweet::alert')
                <div class="panel-body">

                    <div class="form-group">




                        <label for="depart_no" class="col-md-2 control-label">User ID : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="user_code" id="user_code" value="{{ old('id') }}" maxlength ="8" onkeyup="isThaichar(this.value,this)" >

                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">ค้นหาข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>




            <div class="panel panel-danger" >


                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ข้อมูล</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>User_code</th>
                                <th>description_mistake</th>
                                <th>Devolop</th>
                                <th>Time_created</th>
                                <th>Etc</th>




                            </tr>
                            </thead>
                            <tbody>


                                @foreach($tb_transec as $tb_transec2)
                                    <tr data-tr="{{$tb_transec2->NO}}">
                                        <td>{{$tb_transec2->NO}}</td>
                                        <td>{{$tb_transec2->user_code}}</td>
                                        <td>{{$tb_transec2->description_mistake}}</td>
                                        <td>
                                            @if ($tb_transec2->D_devolop == 1)
                                                D1
                                            @elseif ($tb_transec2->D_devolop == 2)
                                                D2
                                            @elseif ($tb_transec2->D_devolop == 3)
                                                D3
                                            @elseif ($tb_transec2->D_devolop == 4)
                                                D4
                                            @elseif ($tb_transec2->D_devolop == 5)
                                                D5
                                            @elseif ($tb_transec2->D_devolop == 6)
                                                D6
                                            @elseif ($tb_transec2->D_devolop == 7)
                                                D7
                                            @elseif ($tb_transec2->D_devolop == 8)
                                                D8
                                            @elseif ($tb_transec2->D_devolop == 9)
                                                V
                                            @elseif ($tb_transec2->D_devolop == 10)
                                                W
                                            @elseif ($tb_transec2->D_devolop == 11)
                                                TM
                                            @else
                                                I don't have any records!
                                            @endif</td>
                                        <td>{{$tb_transec2->user_date}}</td>

                                        </th>

                                        <th>

                                            <a class="btn btn-ngin btn-default"  href="{{ route('admin/transection.transection_index.edit',$tb_transec2->NO) }} "><i class="fa fa-pencil-square-o success" aria-hidden="true"></i></span>Edit</a>


                                        </th>
                                    </tr>
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

        $(function(){
            $('table').dataTable({

                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                responsive: true


            });
        });

        $('#user_code').bind('keyup', function(e){

            var user_code=$('#user_code').val();

            if ($(this).val().length == 8){

                $('#myform').delay(200).submit();

            }

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

        function isThaichar(str,obj){
            var isThai=true;
            var orgi_text="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._-";
            var chk_text=str.split("");
            chk_text.filter(function(s){
                if(orgi_text.indexOf(s)==-1){
                    isThai=false;
                    obj.value=str.replace(RegExp(s, "g"),'');
                }
            });
            return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด*/
        }


    </script>

@endsection
