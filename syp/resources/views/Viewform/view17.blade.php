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


        .div_modal{
            width: 80%;
            margin: auto;
            text-align:center;
        }
        #footer{
            display: table;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }



    </style>



    </head>



    <div class="container">
        <form class="form-horizontal form-border no-margin"  id="type-constraint" method="POST" enctype="multipart/form-data" action="">
            {{ csrf_field() }}

            <div class = 'div_text'>
                <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><b>Performance Development Form – Absence</b></td>
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

                        <td rowspan="2"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" ></td>
                    </tr>
                    <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>

                    <input type="hidden" id='signatures' name="signatures" value="" required>
                    <tr>
                        <td><b>แผนพัฒนาสำหรับ การขาดงานที่ผิดระเบียบบริษัท</b></td>

                    </tr>
                </table>

            </div>
            <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>

            <input type="hidden" id='signatures' name="signatures" value="" required>

            <input type="hidden" name="id2" id="id2" value="{{$id}}">

            <input type="hidden" name="user_code" id="user_code" value="{{$view_report1->user_code}}">
            <input type="hidden" name="mistake_code" id="mistake_code" value="{{$view_report1->mistake_code}}">

            <hr>


            <table border="0" align="center" width="80%">
                <tr>
                    <td>
                        @foreach($view_report as $view_report1)
                            รหัสพนักงาน <b>{{ $view_report1->code_id}}</b> ชื่อ <b>{{ $view_report1->zName }}</b> แผนก <b>{{ $view_report1->department }} </b><?php
                            if($view_report1->type_warning == 1){

                                echo 'สอนงานครั้งที่ ';
                                echo $view_report1->sumt;




                            }elseif ($view_report1->type_warning == 2)
                                echo 'แผนพัฒนา'
                            ?> <b>{{ $view_report1->D_devolop }}</b> วันที่ <b>{{ Carbon\Carbon::parse($view_report1->Last_date)->format('d-m-Y') }}</b>
                        @endforeach
                    </td>
                </tr>
            </table>
            <br>
            <table border="1" align="center" width="80%">
                <tr>
                    <td align="center"><b>ทักษะที่จำเป็น</b></td>
                    <td align="center"><b>ความใส่ใจที่จำเป็น</b></td>
                </tr>
                <tr>
                    <td>1. ทราบกฎระเบียบ ข้อบังคับในการทำงานของบริษัท</td>
                    <td>1. ต้องปฎิบัติตามกฎ ระเบียบ ข้อบังคับในการทำงานของบริษัท</td>

                </tr>
                <tr>
                    <td>2. ทราบขั้นตอน ระเบียบเกี่ยวกับการลางานอย่างถูกต้อง</td>
                    <td>2. หากไม่สามารถมาปฏิบัติงานได้ ต้องแจ้งผู้บังคับบัญชาทราบและอนุมัติการหยุดงาน</td>
                </tr>
                <tr>
                    <td>3. ทราบทลงโทษทางวินัยในหัวข้อการขาดงาน</td>
                    <td>3. ห้ามละทิ้งหน้าที่โดยไม่ได้รับอนุญาติจากผู้บังคับบัญชา</td>
                </tr>
                <tr>
                    <td>4. ทราบช่องทางการแจ้งลางาน และเบอร์ติดต่อที่ถูกต้อง</td>
                    <td>4. พนักงานต้องรายงานข้อเท็จจริงเกี่ยวกับการหยุดงาน</td>
                </tr>



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

                <br>{{ $view_report1->zName }}
                <br>  วันที่  <?php echo date("d/m/Y")?>
            </div>

            <div class='div1'>
                <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">

                    <img src="{{auth::user()->signatures}}" width=200 height=60 />


                </div>


                <br>{{ auth::user()->fname }} {{ auth::user()->lname }}
                <br>  วันที่  <?php echo date("d/m/Y")?>
            </div>



        </div>

        <div class="footer" id="footer">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">บันทึกข้อมูล</button>
        </div>

    </div>



    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ผู้กะทำความผิดเซ็นรับทราบ</h4>
                </div>
                <div class="modal-body">
                    <div class='div_modal'>
                        <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">
                            <canvas id="signature-pad" class="signature-pad" width=200 height=400></canvas>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  id="save" class="btn btn-default" data-dismiss="modal">Save</button>
                    <button type="button"  id="clear" class="btn btn-default" data-dismiss="modal">Clear</button>
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

        saveButton.addEventListener('click', function (event) {


            if (signaturePad.isEmpty()) {
                return alert("Please provide a signature first.");
            }

            var data = signaturePad.toDataURL('image/png');
            var id2=$('#id2').val();
            var flag=$('#flag_comfirm').val();
            var user_code=$('#user_code').val();
            var mistake_code=$('#mistake_code').val();

            $.ajax({

                    url : '/ajax-subcat2',
                    type: 'POST',
                    data: {id2:id2,imgBase64:data,flag:flag,mistake_code:mistake_code,user_code:user_code},



                    success : function(data){


                        //swal('บันทึกข้อมูลเสร็จเรียบร้อย');
                        swal("Good job!", "บันทึกข้อมูลเสร็จเรียบร้อย", "success",{button: false,});
                        setTimeout(function(){  window.location = '{{route('find_user.index')}}'; }, 1000);


                    }
                }
            );

        });


        // Send data to server instead...


        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
        });





        $('#submit_id').click(function() {
            location.reload();
        });



    </script>

@endsection
