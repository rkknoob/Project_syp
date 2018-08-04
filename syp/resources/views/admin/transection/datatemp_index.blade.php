@extends('layouts.endless3')

@section('content')
    <style>

        textarea {
            overflow-y: scroll;
            height: 100px;
            resize: none; /* Remove this if you want the user to resize the textarea */
        }

        .modal-content {
            border-radius: 25px;
            min-height: 16.42857143px;
            padding: 15px;
            border-bottom: 1px solid #e5e5e5;
        }
        .modal-title {
            color: red;
        }


    </style>




    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="/home"> Home</a></li>
            <li class="active">ข้อมูล Master</li>
        </ul>
    </div><!-- breadcrumb -->
    <br>

    <div class="container">
        <form action="{{ route('/admin/transection/datatemp/index/insert') }}" enctype="multipart/form-data"  id="datatemp_insert" method="POST">
            {{ csrf_field() }}

            @if (Session::has('message'))

                <div class="alert alert-success" data-dismiss="alert" aria-label="close">{{ Session::get('message') }}</div>

            @endif


            @if (Session::has('error'))

                <div class="alert alert-warning" data-dismiss="alert" aria-label="close">{{ Session::get('error') }}</div>

            @endif







            <div class="col-md-14">
                <div class="panel panel-success">
                    <div class="panel-heading"><h4>เพิ่มข้อมูล</h4></div>

                    <div class="panel-body">


                        <div class="row">
                            <div class="col-md-2">
                                <label for="depart_no" class="col-md-2 control-label"> Date </label>
                                <input type="text"  class="datepicker form-control" id="document_date1" name="document_date1" required >
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">User Code</label>
                                    <input id="user_code" type="text"  class="form-control"  name="user_code" value="" onkeyup="isThaichar(this.value,this)">

                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Mistake Code</label>

                                    <select name="mistake_code"  class="form-control" id="mistake_code"  required>
                                        <option value="" disabled selected>เลือก</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->mistake_code }}">{{ $item->mistake_code }} : {{ $item->description_mistake }}</option>
                                        @endforeach
                                    </select>



                                </div><!-- /form-group -->
                            </div><!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Details</label>
                                    <textarea rows="4" cols="15" id="details" name="details" class="form-control" maxlength="1000"></textarea>
                                </div><!-- /form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                </div><!-- /form-group -->
                            </div><!-- /.col -->
                            <div class="col">
                                <button class="btn btn-success upload-image" type="submit" id="btnSubmit">บันทึกข้อมูล</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                อัพโหลด PDF

                            </label>
                            <input type="file" name="filename" class="form-control" id="filename">
                        </div>


                    </div>
                </div>
            </div>

        </form>
        <div class="panel panel-danger " >






            <div class="panel panel-default table-responsive">
                <div class="panel-heading">
                    ข้อมูลผู้ติดReport

                </div>
                <div class="panel-body">

                </div>
                <table class="table table-striped" id="responsiveTable">
                    <thead>
                    <tr>
                        <th>
                            <label class="label-checkbox">
                                <input type="checkbox" id="chk-all">
                                <span class="custom-checkbox"></span>
                            </label>
                        </th>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Usercode</th>

                        <th>Mistake</th>
                        <th>View</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datatemp as $datatemp2)
                        <tr>
                            <td>
                                <label class="label-checkbox">
                                    <input type="checkbox" class="chk-row" data-id="{{$datatemp2->id}}">
                                    <span class="custom-checkbox"></span>
                                </label>
                            </td>
                            <td>{{$datatemp2->id}}</td>
                            <td>{{$datatemp2->date_work}}</td>
                            <td>{{$datatemp2->user_code}}</td>

                            <td>{{$datatemp2->mistake_code}}:{{$datatemp2->description_mistake}}</td>
                            @if($datatemp2->upload_pdf == '')
                                <td> <a class="btn btn-warning btn-xs" role="button">No PDF</a></td>
                            @else
                                <td> <a class="btn btn-info btn-xs" target="_blank" href="http://203.151.93.196:8080/uploads/{{$datatemp2->upload_pdf}}" role="button"><i class="fa fa-fw  fa-file-text"></i> ไฟล์เอกสาร</a></td>
                            @endif

                            <th>
                                <button type="button" class="show-modal btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" data-id="{{$datatemp2->id}}" data-title="{{$datatemp2->user_code}}" data-content="{{$datatemp2->detail}}" data-mistake_code="{{$datatemp2->mistake_code}}" data-datetime="{{$datatemp2->date_work}}">

                                <span data-toggle="tooltip" data-placement="top" title="Edit">
                                Edit Data
                                 </span>
                                </button>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /panel -->




            <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('/admin/transection/datatemp/index/update') }}">Clear Data</button>


        </div>


    </div>

    <div id="showModal" class="modal fade" role="dialog">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">ID:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="id_show" disabled ></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">User Code:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="title_show" ></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Mistake:</label>
                            <div class="col-sm-10">
                                <select name="mistake_show"  class="form-control" id="mistake_show"  required autofocus>
                                    @foreach($items as $game)
                                        <option value="{{ $game->mistake_code }}" @if(old('mistake_show') == $game->mistake_code) {{ 'selected' }} @endif>{{ $game->mistake_code }}:{{ $game->description_mistake }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Details:</label>
                            <div class="col-sm-10">


                                <textarea rows="4" cols="15" id="content_show" name="content_show" class="form-control" maxlength="1000" required></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Date:</label>
                            <div class="col-sm-10">
                                <input type="text"  class="datepicker form-control" id="document_date3" name="document_date3" required>
                            </div>
                        </div>


                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="save_data()">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')

    <script>
        $(document).ready(function(){
            $('#mistake_code').select2();
        });


        $("#datatemp_insert").submit(function(){

            $("#btnSubmit").html("ระบบกำลังทำการส่งอีเมล์โปรดรอสักครู่.....");     return true;

            setTimeout(function() { alert("message"); }, time);

        });


        $(function(){
            $('table').dataTable({
                "order": [[ 1, "desc" ]],
                "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
                "ordering": false
            });



        });


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



        $('#document_date3').datetimepicker({
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




        $(document).ready(function () {


            $('#chk-all').on('click', function(e) {
                if($(this).is(':checked',true))
                {
                    $(".chk-row").prop('checked', true);
                } else {
                    $(".chk-row").prop('checked',false);
                }
            });


            $('.delete_all').on('click', function(e) {


                var allVals = [];
                $(".chk-row:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if(allVals.length <=0)
                {
                    alert("Please select row.");
                }  else {


                    var check = confirm("Are you sure you want to delete this row?");
                    if(check == true){


                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type :'get',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {

                                if (data['success']) {
                                    $(".chk-row:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });

                                } else if (data['error']) {

                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {

                            }
                        });


                        setTimeout(function(){  window.location = '{{Route('admin/transection.datatamp_index')}}'; }, 1000);
                    }
                }
            });


            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });





            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();





                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });
        });

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });



        $(".btn-submit").click(function(e){

            e.preventDefault();



            var user_code=$('#user_code').val();
            var mistake_code=$('#mistake_code').val();
            var details=$('#details').val();
            var document_date1=$('#document_date1').val();
            var filename=$('#filename').val();

            if($("#document_date1").val()== '') {

                $("#document_date1").popover({
                    title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                    content : "กรุณาระบุ Date",
                    html: true,
                    placement: 'top',
                    trigger: 'focus'
                });
                $('#document_date1').focus();
                return false;
            }
            if($("#user_code").val()== '') {

                $("#user_code").popover({
                    title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                    content : "กรุณาระบุ user_code",
                    html: true,
                    placement: 'top',
                    trigger: 'focus'
                });
                $('#user_code').focus();
                return false;
            }
            if($("#mistake_code").val()== null) {

                $("#mistake_code").popover({
                    title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                    content : "กรุณาระบุ mistake_code",
                    html: true,
                    placement: 'top',
                    trigger: 'focus'
                });
                $('#mistake_code').focus();
                return false;
            }
            if($("#details").val()== '') {

                $("#details").popover({
                    title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                    content : "กรุณาระบุ details",
                    html: true,
                    placement: 'top',
                    trigger: 'focus'
                });
                $('#details').focus();
                return false;
            }





            $("body").on("click",".upload-image",function(e){
                $(this).parents("form").ajaxForm(options);
            });


            var options = {
                complete: function(response)
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        $("input[name='title']").val('');
                        alert('Image Upload Successfully.');
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                }
            };


            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }



        });


        jQuery(function ($) {
            $.mask.definitions['~'] = '[+-]';
            $("input[name$='document_date1']").mask('9999-99-99');
        });


        function isThaichar(str,obj){
            var isThai=true;
            var orgi_text="ABCDEFGHIFKLMNOPQRSTUVWXYZ1234567890";
            var chk_text=str.split("");
            chk_text.filter(function(s){
                if(orgi_text.indexOf(s)==-1){
                    isThai=false;
                    obj.value=str.replace(RegExp(s, "g"),'');
                }
            });
            return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด*/
        }


        $("body").on("click",".upload-image",function(e){
            $(this).parents("form").ajaxForm(options);
        });


        var options = {
            complete: function(response)
            {
                if($.isEmptyObject(response.responseJSON.error)){
                    $("input[name='user_code']").val('');
                    alert('Image Upload Successfully.');
                }else{
                    printErrorMsg(response.responseJSON.error);
                }
            }
        };


        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Edit ข้อมูลผู้ติดReport');
            $('#id_show').val($(this).data('id'));
            $('#mistake_show').val($(this).data('mistake_code'));
            $('#title_show').val($(this).data('title'));
            $('#content_show').val($(this).data('content'));
            $('#document_date3').val($(this).data('datetime'));
            $('#showModal').modal('show');
        });


        function save_data() {

            var id=$('#id_show').val();
            var user_code=$('#title_show').val();
            var mistake_code=$('#mistake_show').val();
            var details=$('#content_show').val();
            var upload=$('#content_show').val();
            var document_date3=$('#document_date3').val();

            if($("#title_show").val()== '') {

                $("#user_code").popover({
                    title: '<i class="fa fa-exclamation-circle red" aria-hidden="true"></i> แจ้งเตือน',
                    content : "กรุณาระบุ user_code",
                    html: true,
                    placement: 'top',
                    trigger: 'focus'
                });
                $('#user_code').focus();
                return false;
            }

            $.ajax({
                type: 'get',
                url:  '/admin/transection/datatemp/index/edit',
                data: {id:id,
                    user_code:user_code,
                    mistake_code:mistake_code,
                    details:details,document_date3:document_date3},
                success: function( msg ) {


                    if(msg.trim()=='1'){
                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');
                        swal("Good job!", "แก้ไขเรียบร้อย", "success", {
                            button: false,
                        });
                    }
                    setTimeout(function(){  window.location = '{{route('admin/transection.datatamp_index')}}'; }, 2000);




                    // $("#ajaxResponse").append("<div>"+msg+"</div>");
                }
            });


            //alert(link_sent);
        }



    </script>





@endsection
