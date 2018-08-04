@extends('layouts.endless3')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">รายงาน</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('report.week')}}">


            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหาวันที่</h4>
                </div>


                <div class="panel-body">

                    <div class="form-group">
                        <label for="depart_no" class="col-md-2 control-label">วันที่ : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date1" name="document_date1">

                            </div>

                        </div>
                        <label for="depart_no" class="col-md-1 control-label">ถึง : </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"  class="datepicker form-control" id="document_date2" name="document_date2">



                            </div>
                        </div>


                    </div>



                    <div class="form-group">
                        <label for="depart_no" class="col-md-2 control-label">ประเภท</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <select name="mistake_code"  class="form-control" id="mistake_code"   >
                                    <option value=""selected>เลือก</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->mistake_code }}">{{ $item->mistake_code }} : {{ $item->description_mistake }}</option>

                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <label for="depart_no" class="col-md-1 control-label">ระดับ </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <select name="D_devolop"  class="form-control {{ $errors->has('D_devolop') ? ' has-error' : '' }}" id="warn"  >
                                    <option value="">เลือก</option>
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

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">ค้นหาวันที่</button>
                        </div>
                    </div>


                </div>
            </div>



            <div class="panel panel-danger" >


                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ข้อมูลพนักงาน</h4>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ชื่อLog in</th>
                            <th>ชื่อ นามสุกล</th>
                            <th>ประเภท</th>
                            <th>รายละเอียด</th>
                            <th>ประเภทแผน</th>
                            <th>วันที่บันทึก</th>
                            <th>ผู้บันทึก</th>
                            <th>ดาวโหลด</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr data-tr="{{$user->No}}">
                                <td>{{$user->user_code}}</td>
                                <td>{{$user->fname}} {{$user->lname}}</td>
                                <td>{{$user->mistake_code}} {{$user->description_mistake}}</td>
                                <td><?php
                                    if ($user->D_devolop == null){

                                        echo 'C';
                                    } else {


                                        echo $user->D_devolop;
                                    }

                                    ?></td>
                                <td>{{$user->type_warning}}</td>
                                <td>{{$user->user_date}}</td>
                                <td>{{$user->name_login}} {{$user->lname_login}}</td>
                                <th>

                                    <a target="_blank" href="{{url('/test/pdf/admin/report',$user->No)}}" class="btn btn-xs btn-info pull-right"><i class="fa fa-file-pdf-o" style="font-size:24px"></i></a>

                                </th>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel',
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

        $('#document_date1').datetimepicker({
            format: 'YYYY-MM-DD',

            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o',
                close: 'fa fa-close'}

        });

        $('#document_date2').datetimepicker({
            format: 'YYYY-MM-DD',

            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o',
                close: 'fa fa-close'}

        });


    </script>

@endsection
