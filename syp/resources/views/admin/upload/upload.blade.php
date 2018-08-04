<?php
date_default_timezone_set("Asia/Bangkok");
?>

@extends('layouts.endless')

@section('content')
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">Upload</li>
        </ul>
    </div><!-- breadcrumb -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br>
                @include('sweet::alert')


                @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                @endif

                @if (session('alert'))
                    <div class="alert alert-error">
                        {{ session('alert') }}
                    </div>
                @endif


                <div class="panel panel-success ">
                    <div class="panel-heading"><h4> <i class="fa fa-upload" aria-hidden="true"></i> Upload </h4></div>

                    <div class="panel-body">

                        {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true' ,'class'=>'form-horizontal','id'=>"formupload",'name'=>"formupload,'onClick' => 'submitForm()'"  ))   !!}
                        {!! csrf_field() !!}
                        <div class="form-group">


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    {!! Form::label('sample_file','Select File to Import :',['class'=>'col-md-4 control-label']) !!}
                                    {{ csrf_field() }}
                                    <div class="col-md-5">
                                        {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                                        {{ csrf_field() }}
                                        {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="depart_description" class="col-md-4 control-label">วันที่ :</label>

                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="tripid_description" id="tripid_description"  readonly="true" value="<?=date("Y/m/d")?>">


                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal" onclick="att_data()">Upload</button>


                            <!-- {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}-->
                            </div>
                        </div>

                    </div>

                    </div>


            </div>
        </div>
    </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>DOCUMENT NO</th>
                <th>Day Upload</th>

                <th>USER Upload</th>
                <th>CHECK DELETE</th>

                <th>Etc</th>







            </tr>
            </thead>
            <tbody>
            @foreach($upload as $user)
                <tr data-tr="{{$user->DOCUMENT_NO}}">
                    <td>{{$user->DOCUMENT_NO}}</td>

                    <td>{{$user->DOCUMENT_DATE}}</td>
                    <td>{{$user->USER_ID}}</td>
                    <td>{{$user->CHECK_DELETE}}</td>















                    </th>

                    <th>
                        <button type="button" class="btn btn-sm btn-danger" onclick="onDelete('{{$user->DOCUMENT_NO}}')"><i class="fa fa-trash-o"></i>Delete</button>
                    </th>



                </tr>
            @endforeach
            </tbody>
        </table>



    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><label class="fa fa-warning fa-lg"></label> กรุณาตรวจสอบความถูกต้องอีกครั้ง ?</h4>
                </div>
                <div class="modal-body">

                    <table class="table-bordered table-striped">
                        <tr>
                            <td>วันที่</td>
                            <td><div id="date_now"></div></td>
                        </tr>

                        <tr>
                            <td>File Name</td>
                            <td><div id="file_name"></div></td>
                        </tr>


                    </table>

                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal" onclick="save_data()">ตกลง</button>-->
                  {!! Form::submit('ตกลง',['class'=>'btn btn-default']) !!}
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>



            </div>

        </div>
    </div>
    </div>
    {!! Form::close() !!}


@endsection


@section('javascript')

    <script>

        $(function(){
            $('table').dataTable({

                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "order": [[ 1, "desc" ]]


            });
        });

        function onDelete (DOCUMENT_NO) {

            var result = confirm("Want to delete?");
            if (result) {
                //Logic to delete the item
                $.get('/upload/delete/'+DOCUMENT_NO,function (r) {

                    $('[data-tr='+DOCUMENT_NO+']').remove();

                });
            }

        }

        //แสดงการตรวจสอบการอัพโหลด
        function att_data(xx)
        {
            $("#date_now").html($("#tripid_description").val());

            $("#type_l").html($( "input:checked" ).val());

            $("#file_name").html($("#sample_file").val());
            $("#nameupload").html($("#uploadname").val());
        }

        //บันทึกค่าที่เลือก
        function save_data() {
            window.location = $("#data_sent").val();
        }


        function formupload() {

            var frm = document.getElementsByName('contact-form')[0];
            frm.submit(); // Submit the form
            frm.reset();  // Reset all form data
            return false; // Prevent page refresh
        }





    </script>




@endsection
