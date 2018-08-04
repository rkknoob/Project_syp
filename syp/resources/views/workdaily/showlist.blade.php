@extends('layouts.endless')

@section('content')


    <?php //print_r($data)

    function convert_date_dtos($temp_date){
        $date_temp = date_create($temp_date); //ใช้ใน php เวอร์ชั่น 2.6
        //$date_temp = $temp_date;
        $temp = explode("/",(date_format($date_temp, 'd/m/Y')));
        return date($temp['0'])."/".date($temp['1'])."/".date($temp['2']);
    }

    //  กรณีรับค่ามาจาก กรณีโดนแปลงเป็น 10/12/2555 แล้ว
    function convert_date_StoTh2($temp_date){
        $Month=array("01"=>'มกราคม',"02"=>'กุมภาพันธ์',"03"=>'มีนาคม',"04"=>'เมษายน',"05"=>'พฤษภาคม',"06"=>'มิถุนายน',"07"=>'กรกฎาคม',"08"=>'สิงหาคม',"09"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');
        $temp_array = explode('/',$temp_date);
        $temp_yy=$temp_array['2'];
        $temp_mn=$temp_array['1'];
        $temp_dd=$temp_array['0']*1;
        return "วันที่ ".$temp_dd." เดือน ".$Month[$temp_mn]." พ.ศ.".$temp_yy;
    }




    ?>

    <style>

        @media screen and (max-width:650px){
            /* 0px - 479px */

            .hide-columns th:nth-child(4),
            .hide-columns th:nth-child(5),


            .hide-columns td:nth-child(4),  /* ตัด td ของคอลัมน์ที่ 4,5,6,7,8 ออก */
            .hide-columns td:nth-child(5)




            {
                display: none;
            }

            .container2 {
                padding-right: 10px;
                padding-left: 10px;
                margin-right: auto;
                margin-left: auto;
            }


        }



    </style>



    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ข้อผิดพลาดรายวัน</li>

        </ul>
    </div><!-- breadcrumb -->
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <a class="btn btn-default" href="{{Route('workdaily.index')}}" role="button"><i class="glyphicon glyphicon-arrow-left"></i> กลับหน้าหลัก</a>
            </div>
            <div class="col-sm">

            </div>

        </div>
    </div>

    <br></br>


    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            {{ csrf_field() }}


            <div class="panel panel-primary" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-eercast"></i>ข้อผิดพลาดประจำวัน</h4>
                </div>

                <div class="hide-columns table-responsive">
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th >วันที่</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>แผนก</th>
                                <th>ชื่อ ไอดี</th>
                                <th>ประเภท</th>

                                <th>เลือก</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($work_daily as $work_daily2)
                                <tr data-tr="{{$work_daily2->id}}">
                                    <td>

                                       {{$work_daily2->date_work}}
                                    </td>

                                    <td>{{$work_daily2->fname}} {{$work_daily2->lname}}</td>
                                    <td>{{$work_daily2->department}}</td>
                                    <td>{{$work_daily2->user_code}}</td>
                                    <td>{{$work_daily2->mistake_code}}:{{$work_daily2->description_mistake}}
                                    </td>

                                    <th>
                                        <button type="button" class="show-modal btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{$work_daily2->id}}" data-title="{{$work_daily2->user_code}}" data-content="{{$work_daily2->detail}}" data-mistake_code="{{$work_daily2->mistake_code}}:{{$work_daily2->description_mistake}}"><span class="glyphicon glyphicon-eye-open"></span></button>
                                        <a href="{{ route('workdaily.create', [$work_daily2->user_code, $work_daily2->mistake_code, $work_daily2->id]) }}" class="btn btn-primary btn-xs">
                                            เลือก
                                        </a>

                                    </th>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="showModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">user:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="title_show" disabled></textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Type:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="mistake_code" disabled></textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="content">Details:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="content_show" cols="40" rows="5" disabled></textarea>
                                    </div>

                                </div>


                            </form>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
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



        $(document).ready(function() {
            $('table').DataTable({

                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "aLengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
                "iDisplayLength": 50,
                "ordering": true,
                "info":     false,

                "order": [[ 0, "desc" ]],


                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        $(column.header()).append("<br>")
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.header()))
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });
        });

        function onDelete (mistake_code) {

            var result = confirm("Want to delete?");

            if (result) {
                //Logic to delete the item
                $.get('/admin/typemistake/'+mistake_code,function (r) {

                    $('[data-tr='+mistake_code+']').remove();

                });
            }

        }

        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Details');
            $('#id_show').val($(this).data('id'));
            $('#mistake_code').val($(this).data('mistake_code'));
            $('#title_show').val($(this).data('title'));
            $('#content_show').val($(this).data('content'));
            $('#showModal').modal('show');
        });


    </script>




@endsection
