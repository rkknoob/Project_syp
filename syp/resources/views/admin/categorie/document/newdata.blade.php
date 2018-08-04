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

                    {{ Form::open (['route' => 'admin/categorie/document.store', 'enctype' => 'multipart/form-data', 'class'=> 'form', 'method' =>'post', 'files'=> 'true']) }}

                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    หมวดหมู่เอกสาร
                                </label>
                                <select class="form-control" name="categorie_id" required>
                                    <option value="">
                                        เลือกข้อมูล
                                    </option>

                                    <?php
                                    foreach($head_cate as $head_cate2){
                                    ?>
                                    <option value="<?php echo $head_cate2->id; ?>" >
                                        <?php echo $head_cate2->name; ?>
                                    </option>
                                    <?php
                                    } ?>


                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    รหัสเอกสาร
                                </label>
                                <input type="text" id="document_code" class="form-control" name="document_code" value=""required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    ชื่อเอกสาร
                                </label>
                                <input type="text" id="topic" class="form-control" name="topic" value=""required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    อ้างอิงเอกสาร
                                </label>
                                <input type="text" id="reference" class="form-control" name="reference" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    อัพโหลดไฟล์เอกสารใหม่

                                </label>
                                <input type="file" name="user_file" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    รายละเอียด
                                </label>
                                <textarea rows="3" class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-fw fa-save">
                                </i>บันทึกข้อมูล
                            </button>
                            <a class="btn btn-danger" href="" role="button">
                                <i class="fa fa-fw fa-close">
                                </i>ยกเลิก
                            </a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@endsection


<script>





    $('#register_date').datepicker().on(picker_event,function(e)
    {
    });





</script>