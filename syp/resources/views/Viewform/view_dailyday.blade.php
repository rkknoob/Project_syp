@extends('layouts.endless')

@section('content')


    <style>
        .text_size{
            font-size: 25px;
        }

        .nsme_user{
            text-align: center;
        }

        hr{
            width: 80%;
        }


        .div_text{
            width: 80%;
            margin: auto;

        }

        .div_text2{
            width: 80%;
            margin: auto;
            text-align:center;
        }


        .div1 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }
        .div2 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }
        .div3 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }



        #footer{
            display: table;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .signature-pad2 {
            width: 100%;
            text-align:center;
        }

        .modal-dialog {
            width: 325px;
        }








    </style>



    </head>



    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="POST" enctype="multipart/form-data" action="">
            {{ csrf_field() }}




            <div class = 'div_text'>
                <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        @foreach($mistake_t_show_form as $mistake_t_show_form2)
                            <td><b>Performance Development Form – {{$mistake_t_show_form2->description_mistake}}</b></td>


                        @endforeach
                        @foreach($view_report as $view_report1)
                            <?php
                            if ($view_report1->type_warning == 1){

                                echo '<td><span class="text_size">&#9745;</span> Coaching (สอนงาน)</td>';
                            } else if ($view_report1->type_warning == 2){


                                echo '<td><span class="text_size">&#9745;</span> Development (แผนพัฒนา)</td>';
                            } else if ($view_report1->type_warning == 3){


                                echo '<td><span class="text_size">&#9745;</span> Warning (ใบเตือน)</td>';
                            }

                            ?>
                        @endforeach

                        <td rowspan="2"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" ></td>                    </tr>
                    <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>

                    <input type="hidden" id='signatures' name="signatures" value="" required>
                    <tr>
                        <td><b> แผนพัฒนาสำหรับ การปฏิบัติงานให้ได้ตามเป้าหมาย</b></td>

                    </tr>
                </table>

            </div>
            <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>

            <input type="hidden" id='signatures' name="signatures" value="" required>

            <input type="hidden" name="id2" id="id2" value="{{$id}}">

            <input type="hidden" name="user_code" id="user_code" value="{{$view_report1->user_code}}">
            <input type="hidden" name="mistake_code" id="mistake_code" value="{{$view_report1->mistake_code}}">

            <input type="hidden" name="id_temp" id="id_temp" value="{{$datatamp}}">

            <hr>


            <table border="0" align="center" width="80%">
                <tr>
                    <td>
                        @foreach($view_report as $view_report1)
                            @foreach($data_count as $data_count2)
                                รหัสพนักงาน <b>{{ $view_report1->code_id}}</b> ชื่อ <b>{{ $view_report1->zName }}</b> แผนก <b>{{ $view_report1->department }} </b><?php
                                if($view_report1->type_warning == 1){




                                    echo 'สอนงานครั้งที่ ';

                                    echo $data_count2->count_user;





                                }elseif ($view_report1->type_warning == 2)
                                    echo 'แผนพัฒนา'
                                ?> <b><?php
                                    if($data_devo == 1){
                                        echo 'D1';
                                    }else if($data_devo == 2){
                                        echo 'D2';
                                    }else if($data_devo == 3){
                                        echo 'D3';
                                    }else if($data_devo == 4){
                                        echo 'D4';
                                    }else if($data_devo == 5){
                                        echo 'D5';
                                    }else if($data_devo == 6){
                                        echo 'D6';
                                    }else if($data_devo == 7){
                                        echo 'D7';
                                    }else if($data_devo == 8){
                                        echo 'D8';
                                    }else if($data_devo == 9){

                                    }else {}

                                    ?></b> วันที่ @foreach($view_report as $view_report1) <b>{{ Carbon\Carbon::parse($date_datatemp)->format('d-m-Y') }}</b>@endforeach
                            @endforeach
                        @endforeach
                    </td>
                </tr>
            </table>
            <br>




            <table border="1" align="center" width="80%">
                <thead>
                <tr>
                    <td align="center"><b>ทักษะที่จำเป็น</b></td>
                    <td align="center"><b>ความใส่ใจที่จำเป็น</b></td>

                </tr>
                </thead>
                <tbody>
                @foreach($mistake_basic as $mistake_basic2)
                    <tr data-tr="{{$mistake_basic2->mistake_code}}">
                        <td>{{$mistake_basic2->basic}}</td>
                        <td>{{$mistake_basic2->attention}}</td>







                        </th>


                    </tr>
                @endforeach
                </tbody>
            </table>



            <br>

            <table border="0" align="center" width="80%">
                <tr>
                    <td>
                        <b> สิ่งที่ต้องปรับปรุงและพัฒนาให้ถูกต้องในการทำงาน </b>
                    </td>
                </tr>
            </table>

            <table border="1" align="center" width="80%">
                <tr>
                    <td align="center"><b>ข้อผิดพลาดที่พบ</b></td>
                    <td align="center"><b>แผนการปรับปรุงและพัฒนา</b></td>
                    <td align="center"><b>ระยะเวลา</b></td>
                    <td align="center"><b>วันที่ทบทวน</b></td>
                    <td align="center"><b>ผลการปรับปรุง</b></td>
                </tr>
                <tr>
                    <td align="center">{{$view_report1->mistake_description}}</td>
                    <td align="center">{{$view_report1->devolop_plan}}</td>
                    <td align="center"><?php if ($view_report1->timlength == '1'){

                            echo ' ทันที';

                        }else if ($view_report1->timlength == '2'){

                            echo ' 1 วัน';
                        }else if($view_report1->timlength == '3'){
                            echo ' 3 วัน';

                        }else if($view_report1->timlength == '4'){
                            echo ' 5 วัน';

                        }else if($view_report1->timlength == '5'){
                            echo ' 1 สัปดาห์';

                        }?></td>
                    <td align="center">{{ \Carbon\Carbon::parse($view_report1->date_review)->format('d/m/Y')}}</td>
                    <td align="center">...</td>
                </tr>
                <tr>
                    <td align="center">...</td>
                    <td align="center">...</td>
                    <td align="center">...</td>
                    <td align="center">...</td>
                    <td align="center">...</td>
                </tr>
                <tr>
                    <td align="center">...</td>
                    <td align="center">...</td>
                    <td align="center">...</td>
                    <td align="center">...</td>
                    <td align="center">...</td>
                </tr>



            </table>
            <br>

        </form>
        <div class="div_text">
            ท่านต้องการให้หัวหน้างานช่วยเหลืออย่างไรบ้าง………………………………………………………………………………………………………………………………………………………
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอสัญญาว่า จะนำแผนการพัฒนาไปปฏิบัติตามอย่างเคร่งครัด และรายงานผลให้หัวหน้าทราบ ซึ่งข้าพเจ้าทราบดีว่า แผนพัฒนานี้ มีเจตนามุ่งหวังที่จะช่วยท่านในการปรับปรุง พฤติกรรมการทำงานให้เป็นไปตามระเบียบข้อบังคับที่บริษัทฯ
            กำหนด โดยยังไม่ใช่การลงโทษทางวินัย โดยยังไม่ใช่การลงโทษทางวินัย  หากข้าพเจ้ายังไม่มีการปรับปรุง จะถูกดำเนินการทางวินัยต่อไป
        </div>

        <br>

        <div class="div_text2">
            <div class='div1'>
                <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">
                    <canvas id="signature-pad1" class="signature-pad" width=200 height=60></canvas>
                </div>
                <span style="border-bottom: black 1px dotted">
                <br> ลงชื่อพนักงาน {{ $view_report1->zName }}</span>
                <br>  วันที่  <?php echo date("d/m/Y")?>
            </div>

            <div class='div1'>
                <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">

                    <img src="{{auth::user()->signatures}}" width=200 height=60 />


                </div>
                <br>
                <span style="border-bottom: black 1px dotted">ลงชื่อผู้บังคับบัญชา
                    {{ auth::user()->fname }} {{ auth::user()->lname }}</span>
                <br>  วันที่  <?php echo date("d/m/Y")?>
            </div>



        </div>

        <div class="footer" id="footer">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">บันทึกข้อมูล</button>
        </div>

    </div>



    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="clear2" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ผู้กะทำความผิดเซ็นรับทราบ</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="suggestion" class="form-control-label">ข้อเสนอแนะ :</label>
                        <input type="text" class="form-control" id="suggestion" required>

                    </div>
                    <div class='div_modal'>
                        <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">
                            <canvas id="signature-pad" class="signature-pad2"  height=280></canvas>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  id="save" class="btn btn-default" data-dismiss="modal" >Save</button>

                    <button id="clear" class="btn btn-default" >Clear</button>
                </div>
            </div>

        </div>
    </div>




@endsection


@section('javascript')

    <script>

        $(function(){
            $('table').dataTable({


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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');
        var cancelButton2 = document.getElementById('clear2');

        saveButton.addEventListener('click', function (event) {


            if (signaturePad.isEmpty()) {
                return alert("Please provide a signature first.");
            }

            var data = signaturePad.toDataURL('image/png');
            var id2=$('#id2').val();
            var flag=$('#flag_comfirm').val();
            var user_code=$('#user_code').val();
            var mistake_code=$('#mistake_code').val();
            var suggestion=$('#suggestion').val();
            var id_temp=$('#id_temp').val();

            url = "{{ route('workdaily.seach', ['user_code' => '']) }}" + "" + user_code;

            $.ajax({

                    url : '/ajax-subcat2',
                    type: 'POST',
                    data: {id2:id2,imgBase64:data,flag:flag,mistake_code:mistake_code,user_code:user_code,suggestion:suggestion,id_temp:id_temp},



                    success : function(data){

                        if(data =='1'){
                            //swal('บันทึกข้อมูลเสร็จเรียบร้อย');

                            swal("Complete!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success");
                            buttons: false

                            setTimeout(function(){  window.location = url; }, 1000);

                        }else if(data =='2'){


                            swal('แจ้งเตือน', 'ข้อมูลนี้ถูกบันทึกก่อนหน้านี้แล้ว' , 'error', {
                                button: false,
                            });

                            setTimeout(function(){  window.location = '{{route('workdaily.index')}}'; }, 1000);

                        }else if(data =='3'){
                            swal('แจ้งเตือน', 'Trip id นี้ไม่มี หรือคุณยังไม่ได้กรอก' , 'error', {

                                button: false,

                            });

                        }
                        else if(data =='4'){
                            swal(
                                'แจ้งเตือน', 'Trip id เริ่มงานไปแล้ว' , 'error',{


                                    button: false,

                                });

                        }


                    }
                }
            );

        });


        // Send data to server instead...


        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
            document.getElementById("suggestion").value = '';
        });
        cancelButton2.addEventListener('click', function (event) {
            signaturePad.clear();
            document.getElementById("suggestion").value = '';
        });






        $('#submit_id').click(function() {
            location.reload();
        });

        jQuery(function ($) {
            $.mask.definitions['~'] = '[+-]';


            $("input[name$='date_review']").mask('9999_99_99');




        });



    </script>

@endsection
