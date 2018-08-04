@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">แสดงข้อมูล</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    @if (Session::has('message'))

        <div class="alert alert-warning" data-dismiss="alert" aria-label="close" http-equiv="refresh">{{ Session::get('message') }}<meta http-equiv="refresh"></div>
        <meta http-equiv="refresh" content="">
    @endif

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="myform" method="GET">



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
                            <div class ="col-md-2">
                                <label for="depart_no" class="control-label">แผนก :</label>
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
                                <th>day</th>

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

                                >

                                   @if($results2->D1 == '1')

                                        <?php
                                        $test = '1'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}" target="_blank"> {{$results2->D1}}</a></td>
                                @elseif($results2->D1 == '0')
                                    {{$results2->D1 }}
                                    @else

                                    {{$results2->D1 }}


                                @endif

                                <td <?php


                                    if($results2->D2 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->D2 == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '2'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->D2}}</a></td>
                                       @elseif($results2->D2 == '0')

                                           {{$results2->D2}}

                                           @elseif ($results2->D2 == '1' && $results2->Desc1 == "Summary")

                                           {{$results2->D2}}
                                           @else

                                           {{$results2->D2 }}


                                @endif

                                <td <?php


                                    if($results2->D3 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->D3 == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '3'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->D3}}</a></td>
                                @elseif($results2->D3 == '0')

                                    {{$results2->D3}}

                                @elseif ($results2->D3 == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->D3}}
                                @else

                                    {{$results2->D3 }}


                                @endif
                                <td <?php


                                    if($results2->D4 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >
                                    <?php
                                    $test = '4'; ?>
                                    @if($results2->D4 == '1' && $results2->Desc1 !== "Summary")


                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}" target="_blank"> {{$results2->D4}}</a></td>
                                @elseif($results2->D4 == '0')

                                    {{$results2->D4}}

                                @elseif ($results2->D4 == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->D4}}


                                @endif
                                <td <?php


                                    if($results2->D5 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->D5 == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '5'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}" target="_blank"> {{$results2->D5}}</a></td>
                                @elseif($results2->D5 == '0')

                                    {{$results2->D5}}

                                @elseif ($results2->D5 == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->D5}}


                                @endif
                                <td <?php


                                    if($results2->D6 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->D6 == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '6'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->D6}}</a></td>
                                @elseif($results2->D6 == '0')

                                    {{$results2->D6}}

                                @elseif ($results2->D6 == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->D6}}
                                @else

                                    {{$results2->D6 }}


                                @endif
                                <td <?php


                                    if($results2->D7 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->D7 == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '7'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->D7}}</a></td>
                                @elseif($results2->D7 == '0')

                                    {{$results2->D7}}

                                @elseif ($results2->D7 == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->D7}}
                                @else

                                    {{$results2->D7 }}


                                @endif
                                <td <?php


                                    if($results2->D8 == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->D8 == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '8'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->D8}}</a></td>
                                @elseif($results2->D8 == '0')

                                    {{$results2->D8}}

                                @elseif ($results2->D8 == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->D8}}
                                @else

                                    {{$results2->D8 }}


                                @endif
                                <td <?php


                                    if($results2->V == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->V == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '9'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->V}}</a></td>
                                @elseif($results2->V == '0')

                                    {{$results2->V}}

                                @elseif ($results2->V == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->V}}

                                    @else
                                    {{$results2->V}}


                                @endif
                                <td <?php


                                    if($results2->W == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->W == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '10'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->W}}</a></td>
                                @elseif($results2->W == '0')

                                    {{$results2->W}}

                                @elseif ($results2->W == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->W}}

                                @else
                                    {{$results2->W}}


                                @endif
                                <td <?php


                                    if($results2->TM == '0'){


                                        echo "bgcolor=#d6d1c2";
                                    }
                                    ?>

                                >

                                    @if($results2->TM == '1' && $results2->Desc1 !== "Summary")

                                        <?php
                                        $test = '11'; ?>
                                        <a href="{{url('/test/pdf',$results2->Desc1)}}/{{$test}}"target="_blank"> {{$results2->TM}}</a></td>
                                @elseif($results2->TM == '0')

                                    {{$results2->TM}}

                                @elseif ($results2->TM == '1' && $results2->Desc1 == "Summary")

                                    {{$results2->TM}}

                                @else
                                    {{$results2->TM}}



                                @endif



                                <td>@if($results2->last_day == '0' && $results2->Desc1 == "Summary" )
                                        {{''}}

                                    @elseif ($results2->last_day !== '')
                                        {{$results2->last_day}}
                                    @endif</td>
                                <td>@if($results2->Day_Now == '0' && $results2->Desc1 == "Summary" )
                                        {{''}}

                                    @elseif ($results2->Day_Now !== '')
                                        {{$results2->Day_Now}}
                                    @endif</td>




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
