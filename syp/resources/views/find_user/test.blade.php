@extends('layouts.app')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">บันทึกความผิด</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="{{route('find_user.index')}}">
            {{ csrf_field() }}

            <div class="panel panel-danger " >
                <div class="panel-heading">
                    <h4> <i class="fa fa-search " ></i> ค้นหารายชื่อ</h4>
                </div>


                <div class="panel-body">

                    <div class="form-group">
                        <label for="depart_no" class="col-md-3 control-label">เลือกประเภทการค้นหา : </label>
                        <div class="col-md-2">
                            <select name="type_user" class="form-control">
                                <option value="0">เลือกประเภท</option>
                                <option value="user_code_e">รหัสพนักงาน</option>
                                <option value="name">ชื่อพนักงาน</option>
                            </select>
                        </div>
                        <label for="depart_no" class="col-md-2 control-label">ระบุคำค้นหา : </label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="txtname" id="txtname" value="{{ old('id') }}"required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" id="submit_id">ค้นหารายชื่อ</button>
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
                            <th>ลำดับ</th>
                            <th>รหัสพนักงาน</th>
                            <th>ชื่อล็อคอิน</th>
                            <th>ชื่อพนักงาน</th>
                            <th>นามสกุลพนักงาน</th>
                            <th>แผนก</th>
                            <th>เลือก</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr data-tr="{{$user->id}}">
                                <td>{{$user->id}}</td>
                                <td>{{$user->user_code}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->fname}}</td>
                                <td>{{$user->lname}}</td>
                                <td>{{$user->department}}</td>
                                <td>    <a href="{{Route('devo', ['user_code' => $user->user_code]) }}" class="btn btn-warning btn-xs">
                                        บันทึกความผิด
                                    </a>
                                </td>
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
                "sPaginationType": "full_numbers"

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

    </script>

@endsection
