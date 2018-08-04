@extends('layouts.endless')

@section('content')

    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ประเภทความผิด</li>

        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="GET" action="">
            {{ csrf_field() }}

            <div class="panel panel-danger" >
                <div class="panel-heading">
                    <h4> <i class="fa fa-address-card "></i> ประเภทความผิด</h4>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Description mistake</th>
                            <th>Cnt_alert</th>
                            <th>Etc</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($tb_mistake_sum as $tb_mistake_sum2)
                            <tr data-tr="{{$tb_mistake_sum2->mistake_code}}">
                                <td>{{$tb_mistake_sum2->mistake_code}}</td>
                                <td>{{$tb_mistake_sum2->description_mistake}}</td>
                                <td>{{$tb_mistake_sum2->cnt_alert}}</td>


                                </th>
                                <th>
                                    <a href="{{Route('admin.typemistake')}}" class="btn btn-warning btn-xs">
                                        Create
                                    </a>
                                    <a href="{{Route('typemistakeedit.update',$tb_mistake_sum2->mistake_code)}}" class="btn btn-warning btn-xs">
                                        แก้ไข
                                    </a>
                                    <a class="btn btn-danger btn-xs" onClick="onDelete({{$tb_mistake_sum2->mistake_code}})">
                                        ลบ
                                    </a>
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
                "order": [[ 0, "desc" ]],
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"

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

    </script>

@endsection
