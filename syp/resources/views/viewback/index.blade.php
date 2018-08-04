@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ดูย้อนหลัง</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    @if (Session::has('message'))

        <div class="alert alert-warning" data-dismiss="alert" aria-label="close" http-equiv="refresh">{{ Session::get('message') }}<meta http-equiv="refresh"></div>
        <meta http-equiv="refresh" content="">
    @endif

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="myform" method="GET">


            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหาข้อมูล</h4>
                </div>


                <div class="panel-body">

                    <div class="form-group">


                        <label for="depart_no" class="col-md-2 control-label">ระบุชื่อพนักงาน : </label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="user_code" id="user_code" value="{{ old('id') }}" maxlength ="8">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">ค้นหาข้อมูล</button>
                        </div>

                    </div>



                </div>
            </div>
            @foreach($data_user as $data_user2)
                <div class="panel panel-danger " >
                    <div class="panel-heading">
                        <h4> <i class="fa fa-search " ></i> ข้อมูลพนักงาน</h4>
                    </div>



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
                            <div class ="col-md-4">
                                <label for="depart_no" class="control-label">แผนก :</label>
                                <label for="depart_no" class="control-label" >{{$data_user2->department}}</label>
                            </div>
                            <div class ="col-md-4">
                                <label for="depart_no" class="control-label">วันที่เริ่มงาน :</label>
                                @foreach($time_working as $time_working2)
                                    <label for="depart_no" class="control-label"><?php
                                        if($data_user2->created_at !=''){
                                            $date_temp = date_create($data_user2->work_dat);
                                            echo  date_format($date_temp, 'd-m-Y');
                                        }else{
                                            echo 'ไม่มีข้อมูล';
                                        }

                                        ?></label>
                                @endforeach
                            </div>
                            <div class ="col-md-4">
                                <label for="depart_no" class="control-label">อายุงาน :</label>
                                <label for="depart_no" class="control-label">{{$time_working2->year}} ปี {{$time_working2->month}} เดือน</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach









            <div class="panel panel-danger" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ข้อมูลพนักงาน</h4>
                </div>
                <div class="table-responsive">
                    <div class="panel-body">
                        <table class="table table-bordered" id="data_main">
                            <thead>
                            <tr>
                                <th>Subject of syp</th>
                                <th>D1</th>
                                <th>D2</th>
                                <th>D3</th>
                                <th>D4</th>
                                <th>D5</th>
                                <th>D6</th>
                                <th>D7</th>
                                <th>D8</th>
                                <th>V</th>
                                <th>W</th>
                                <th>TM</th>
                                <th>ครบรอบ</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($res as $results2)

                                <td>{{$results2->Desc1}}</td>
                                <td <?php
                                    if($results2->D1 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>
                                >{{$results2->D1}}</td>
                                <td
                                <?php
                                    if($results2->D2 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>






                                >{{$results2->D2}}</td>
                                <td
                                <?php
                                    if($results2->D3 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>


                                >{{$results2->D3}}</td>
                                <td
                                <?php
                                    if($results2->D4 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >{{$results2->D4}}</td>
                                <td <?php
                                    if($results2->D5 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>
                                >{{$results2->D5}}</td>
                                <td
                                <?php
                                    if($results2->D6 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>


                                >{{$results2->D6}}</td>
                                <td
                                <?php
                                    if($results2->D7 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>





                                >{{$results2->D7}}</td>
                                <td
                                <?php
                                    if($results2->D8 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>



                                >{{$results2->D8}}</td>
                                <td
                                <?php
                                    if($results2->V == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>



                                >{{$results2->V}}</td>
                                <td
                                <?php
                                    if($results2->W == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>


                                >{{$results2->W}}</td>
                                <td

                                <?php
                                    if($results2->TM == '0'){


                                        echo "bgcolor=#B22222";
                                    }
                                    ?>




                                >{{$results2->TM}}</td>
                                <td>{{$results2->rkknoob}}</td>







                                </th>




                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label> ประวัติ</h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-danger" >
                                    <div class="panel-heading">
                                        <h4> <i class="fa fa-address-card "></i> ประวัติแผนพัฒนา</h4>
                                    </div>
                                    <table class="table table-bordered" id="myTable_d">
                                        <thead>
                                        <tr>
                                            <th>ครั้งที่</th>
                                            <th>เรื่อง</th>
                                            <th>ประเภท</th>
                                            <th>วันที่บันทึก</th>
                                            <th>ผู้บันทึก</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="panel panel-danger" >
                                    <div class="panel-heading">
                                        <h4> <i class="fa fa-address-card "></i> ประวัติใบเตือน</h4>
                                    </div>

                                    <table class="table table-bordered" id="myTable_d_warning">
                                        <thead>
                                        <tr>
                                            <th>ครั้งที่</th>
                                            <th>เรื่อง</th>
                                            <th>ประเภท</th>
                                            <th>วันที่บันทึก</th>
                                            <th>ผู้บันทึก</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
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
            $('#data_main').dataTable({
                "lengthMenu": [[50, -1], [50, "All"]],
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bFilter": false,
                "lengthChange": false,
                "bPaginate": false,
                "ordering": false,
                "info":     false,

            });
        });


        $(function(){
            $('table1').dataTable({
                "pageLength": 50,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "order": [[ 0, "desc" ]],

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

        function show_data(mistake_code,user_code)
        {
            var mistake_code = mistake_code;
            var user_code = user_code;

            $('#myTable_d tbody > tr').remove();
            $.ajax({
                type :'get',
                data: {mistake_code:mistake_code,user_code:user_code},
                url: "/view_user/show/",
                dataType: "json",
                success : function(data){
                    $.each(data, function (varname, varvalue){

                        $('#myTable_d').append('<tr>' +
                            '<td>'+varvalue.num+'</td>' +
                            '<td>'+varvalue.mistake_code+':'+varvalue.description_mistake+'</td>' +
                            '<td>'+varvalue.type_warning+'</td>' +
                            '<td>'+varvalue.user_date+'</td>' +
                            '<td>'+varvalue.user_login+'</td>' +
                            '</tr>');
                    });


                }
            });

            $('#myTable_d_warning tbody > tr').remove();
            $.ajax({
                type :'get',
                data: {mistake_code:mistake_code,user_code:user_code},
                url: "/view_user/show/warning/",
                dataType: "json",
                success : function(data){
                    $.each(data, function (varname, varvalue){

                        $('#myTable_d_warning').append('<tr>' +
                            '<td>'+varvalue.num+'</td>' +
                            '<td>'+varvalue.mistake_code+':'+varvalue.description_mistake+'</td>' +
                            '<td>'+varvalue.type_warning+'</td>' +
                            '<td>'+varvalue.user_date+'</td>' +
                            '<td>'+varvalue.user_login+'</td>' +
                            '</tr>');
                    });


                }
            });






        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $('#user_code').bind('keyup', function(e){

            var user_code=$('#user_code').val();

            if ($(this).val().length == 8){

                $('#myform').delay(200).submit();

            }

        });










    </script>

@endsection
