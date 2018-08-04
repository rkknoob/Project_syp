@extends('layouts.endless4')

@section('content')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            หมวดหมู่เอกสาร
            <small>หมวดหมู่เอกสารจัดการแบ่งแยกเอกสารออกเป็นหมวด</small>
        </h1>
        <ol class="breadcrumb">

            @if (Session::has('message'))

                <div class="alert alert-warning" data-dismiss="alert" aria-label="close" http-equiv="refresh">{{ Session::get('message') }}</div>

            @endif

            <li><i class="fa fa-dashboard"></i><a href="/home"> Home</a></li>
            <li class="active">หมวดหมู่เอกสาร</li>
        </ol>
    </section>
    <!-- Top menu -->

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ตารางข้อมูล</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-success" href="{{Route('admin/categorie.newdata')}}" role="button"><i class="fa fa-fw fa-plus-circle"></i> เพิ่มข้อมูล</a>

                            <a class="btn btn-default" href="" role="button"><i class="fa fa-fw fa-refresh"></i> Refresh Data</a>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">


                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 30%;">ชื่อหมวดหมู่</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">รายละเอียด</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:  60px;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($car as $car2)
                                    <tr data-tr="{{$car2->id}}">
                                        <td>{{$car2->name}}</td>
                                        <td>{{$car2->description}}</td>


                                        <td>
                                            <button type="button" class="show-modal btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{$car2->id}}"><i class="fa fa-fw fa-trash"></i>Delete</button>
                                        </td>

                                    </tr>



                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Total  entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div id="example1_paginate" class="dataTables_paginate paging_simple_numbers">

                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div id="showModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">



                    <p>คุณต้องการลบข้อมูลนี้หรือไม่</p>

                <form class="form-horizontal" role="form">

                    <div class="form-group">

                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id_show"></input>
                        </div>

                    </div>








                </form>

                <div class="modal-footer">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="save_data()">ตกลง</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
                $.get('/admin/categorie/del/'+id,function (r) {

                    $('[data-tr='+id+']').remove();

                });
            }

        }





        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('ข้อความแจ้งเตือน');
            $('#id_show').val($(this).data('id'));
            $('#mistake_code').val($(this).data('mistake_code'));
            $('#title_show').val($(this).data('คุณต้องการลบข้อมูลนี้หรือไม่'));
            $('#content_show').val($(this).data('คุณต้องการลบข้อมูลนี้หรือไม่'));
            $('#showModal').modal('show');
        });


        function save_data() {

            var id=$('#id_show').val();




            $.ajax({
                type: 'get',
                url:  '/admin/categorie/del/',
                data: {id:id},
                success: function( msg ) {

                    setTimeout(function(){  window.location = '{{route('admin/categorie.mainpage')}}'; }, 0);


                }
            });


            //alert(link_sent);
        }














    </script>

@endsection