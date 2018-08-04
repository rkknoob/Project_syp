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

                <li><i class="fa fa-dashboard"></i><a href="/home"> Home</a></li>
                <li class="active">หมวดหมู่เอกสาร</li>
            </ol>
        </section>
        <!-- Top menu -->

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">เพิ่มข้อมูล</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{route('admin/categorie.store')}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ชื่อหมวดหมู่</label>
                                <input type="text" id="name" class="form-control" name="name" value="" required>
                            </div>
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea rows="3" class="form-control" id="description" name="description" required></textarea>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-save"></i> บันทึกข้อมูล</button>
                            <a class="btn btn-danger" href="" role="button"><i class="fa fa-fw fa-close"></i> ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@endsection