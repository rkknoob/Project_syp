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
                    <h4> <i class="fa fa-address-card "></i> ข้อผิดพลาดที่พบ</h4>
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
