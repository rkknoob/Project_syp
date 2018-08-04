@extends('layouts.endless')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="panel-body">
                <div class="text-center">
                    <a class="btn btn-app" href="{{Route('home')}}">
                        <i class="fa fa-home fa-5x"></i>หน้าหลัก
                    </a>


                    <a class="btn btn-app" href="{{Route('admin/categorie.mainpage')}}">
                        <i class="fa fa-file-text fa-5x"></i>  จัดการเอกสาร
                    </a>
                    <a class="btn btn-app" href="{{Route('admin/type_mistake_master.datamaster')}}">
                        <i class="fa fa-file-text fa-5x"></i>  ข้อผิดพลาด
                    </a>

                    <a class="btn btn-app" href="{{Route('admin/upload.index')}}">
                        <i class="fa fa-file-text fa-5x"></i>  Upload
                    </a>
                    <a class="btn btn-app" href="{{Route('admin/transection.index')}}">
                        <i class="fa fa-eercast fa-5x"></i>   ข้อมูล Master
                    </a>
                    <a class="btn btn-app" href="{{Route('user_login.index')}}">
                        <i class="fa fa-user-circle-o fa-5x"></i>   ตั้งค่าผู้ใช้งาน
                    </a>


                </div>
            </div>
        </div>
    </div>
@endsection
