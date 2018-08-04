@extends('layouts.endless')

@section('content')
    <?php //print_r($data)

    function convert_date_dtos($temp_date){
        $date_temp = date_create($temp_date); //ใช้ใน php เวอร์ชั่น 2.6
        //$date_temp = $temp_date;
        $temp = explode("/",(date_format($date_temp, 'd/m/Y')));
        return date($temp['0'])."/".date($temp['1'])."/".date($temp['2']+543);
    }

    //  กรณีรับค่ามาจาก กรณีโดนแปลงเป็น 10/12/2555 แล้ว
    function convert_date_StoTh2($temp_date){
        $Month=array("01"=>'มกราคม',"02"=>'กุมภาพันธ์',"03"=>'มีนาคม',"04"=>'เมษายน',"05"=>'พฤษภาคม',"06"=>'มิถุนายน',"07"=>'กรกฎาคม',"08"=>'สิงหาคม',"09"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');
        $temp_array = explode('/',$temp_date);
        $temp_yy=$temp_array['2'];
        $temp_mn=$temp_array['1'];
        $temp_dd=$temp_array['0']*1;
        return "วันที่ ".$temp_dd." เดือน ".$Month[$temp_mn]." พ.ศ.".$temp_yy;
    }




    ?>


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
        .text-left {
            text-align: left;
            padding: 10px;
        }

        .div_text{
            width: 100%;
            margin: auto;
            font-size: 15px;

        }

        .div_text2{
            width: 80%;
            margin: auto;
            text-align:center;
        }

        .div_text3{
            text-align:center;
            font-size: 11px;

        }

        .div_text4{
            padding-right: 20px;

            text-align:right;

        }


        .div_textlast{
            padding: 5px;


        }




        .div_text5{

            padding: 5px;

        }


        .div_border1 {
            border-style: solid;

            width: 100%;

        }


        .div_table {
            border-style: solid;



        }


        .div_border_last {

            text-align:center;
            padding: 10pt;
            display: inline-block;
            border-style: solid;
            border-width: 5px;

            width: 300px;
            height: 150px;

        }

        .div2 {

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
        .div4 {

            text-align:left;
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

        .dotted {
            text-decoration: underline;
            text-decoration-style:dotted;
        }

    </style>
    </head>
    @foreach($view_report as $view_report1)
        <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>

        <input type="hidden" id='signatures' name="signatures" value="" required>


        <input type="hidden" name="id2" id="id2" value="{{$id}}">

        <input type="hidden" name="user_code" id="user_code" value="{{$view_report1->user_code}}">
        <input type="hidden" name="mistake_code" id="mistake_code" value="{{$view_report1->mistake_code}}">
        <input type="hidden" name="D_devolop" id="D_devolop" value="{{$view_report1->D_devolop}}">

    @endforeach




    <div class="container">
        <div class = 'div_text'>
            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td rowspan="1"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" ></td>
                    <td> <B>บริษัท เอก - ชัย ดิสทริบิวชั่น ซิสเทม จำกัด </B></td>
                </tr>
            </table>
        </div>


            <div class = 'div_border1'>
                <table border="0" align="center" width="100%" >
                    <tr>
                        <td>
                            <br>
                            <b>
                                <p class="text-center"><U>หนังสือเตือน</U></p>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            หนังสือฉบับนี้ทำขึ้นที่บริษัทเอก-ชัย ดีสทริบิวชั่น ซิสเทม จำกัด เลขที่  72 หมู่ 11 ต.ท่าพระ อ.เมือง  จังหวัดขอนแก่น 13170
                        </td>
                    </tr>
                    <td>
                        <br>
                        <div class="div_text4">

                            <tr> <td align="right"> {{ convert_date_StoTh2(convert_date_dtos($view_report1->Last_date)) }}</td> </tr>

                        </div>
                    </td>

                    </tr>
                </table>


                <table border="0" align="center" width="100%">
                    <tr>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรียน
                             <span class="dotted"><b>{{ $view_report1->zName }} </b></span>
                            รหัสพนักงาน <span class="dotted"><b>{{ $view_report1->code_id}} </b></span>
                            ตำแหน่ง <span class="dotted"><b>{{ $view_report1->position}} </b></span>
                            แผนก <span class="dotted"><b>{{ $view_report1->department }} </b></span>
                            ฝ่าย <span class="dotted"><b>Operation สาขา ศูนย์กระขายสินค้าเทสโก้โลตัส สาขา ขอนแก่น </b></span>
                        </td>
                    </tr>
                </table><br>



                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ท่านได้กระทำผิดระเบียบข้อบังคับเกี่ยวกับการทำงานของบริษัทหมวดที่ 6 เรื่องวินัยและโทษทางวินัย
                </div>
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 1.2 ต้องปฎิบัติตามระเบียบ ข้อบังคับ ประกาศ คำสั่ง และนโยบายของบริษัท
                </div>
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 1.3 ต้องเชื่อฟังและปฎิบัติตามคำสั่งโดยชอบของผู้บังคัญบัญชาเกี่ยวกับการปฎิบัติงารและ / หรือการใช้อุปกรณ์ในการปฎิบัติงานต่าง ๆ โดยเคร่งครัด และมีสัมมาคาระวะต่อผู้บังคับบัญชา หรือผู้มีตำแหน่งสูงกว่า
                </div>
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 1.6 ต้องปฎิบัติตามกฎ ข้อบังคับและระเบียบความปลอดภัยในการทำงานอย่างเคร่งครัด
                </div>
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 2.11 ห้ามประพฤติในทางไม่เอาใจใส่ และขาดมาตราฐานในการปฎิบัติ จนทำให้บริษัทเสี่ยวต่อการสูญเสีย เสียหานทางธุรกิจ การเงิน ชื่อเสียง หรือละเลยในการปฎิบัติหน้าที่ให้ได้ตามเกณฑ์ขั้นต่ำในนการผลิต หรือคุณภาพ
                </div>
                <br>

                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ซึ่งมีรายละเอียดดังต่อไปนี้  กล่าวคือ <span class="dotted"><b>{{$view_report1->description}} </b></span>
                </div>

                <br>


                <div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    จึงเห็นสมควร
                </div>
                <div><?php
                    if($view_report1->test == 'V'){
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&#9745;] ตักเตือนด้วยวาจา';

                    }


                    ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    [.....] ตักเตือนด้วยวาจา<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    [.....] ตักเตือนเป็นลายลักษณ์อักษร<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    [.....] ตักเตือนเป็นลายลักษณ์อักษร และพักงานโดยไม่จ่ายค่าจ้าง เป็นระยะเวลา วันทำงาน คือตั้งแต่วันที่ ..................... จนถึงวันที่ ........................<br>
                </div>
                <br>
                <div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    บริษัทขอเตือนให้ท่านประพฤติปฏิบัติตามระเบียบข้อบังคับของบริษัท โดยเคร่งครัด และแก้ไขปรับปรุงตนให้ดีขึ้น หากปรากฎว่าท่านยังคงประพฤติปฎิบัติผิดระเบียบข้อบังคับของบริษัท ในข้อดังกล่าวหรือในข้ออื่นๆ อีก บริษัทจะพิจารณาลงโทษทางวินัยสถานหนักขึ้นตามขอบังคับต่อไป

                </div>
                <br>

                <div style="width:100%" align="center">
                    ลงชื่อ.......................................................ผู้บังคับบัญชา<br>
                    (...........................................................................)<br>
                    ตำแหน่ง..............................................................
                </div>
                <div style="text-align: center;">
                    <div class="div1">
                        ลงชื่อ.......................................................พย<br>
                        (...........................................................................)<br>
                        ตำแหน่ง..............................................................
                    </div>
                    <div class="div2">
                        ลงชื่อ.......................................................ผู้บังคับบัญชา<br>
                        (...........................................................................)<br>
                        ตำแหน่ง..............................................................
                    </div>
                </div>

                <div style="text-align: center;">
                    <div class="div_border_last">
                        พนักงานรับทราบ<br>
                        ลงชื่อ.......................................................<br>
                        (...........................................................................)<br>
                        ตำแหน่ง..............................................................<br>
                        วันที่....................................................<br><br>
                    </div>
                    <div class="div_border_last">
                        ฝ่ายบุคคล<br>
                        ลงชื่อ.......................................................<br>
                        (...........................................................................)<br>
                        ตำแหน่ง..............................................................<br>
                        วันที่....................................................<br><br>
                    </div>
                    <div class="div_border_last">
                        1.ต้นฉบับ<br>
                        - เก็บเข้าแฟ้มประวัติพนักงาน<br>
                        2. สำเนา<br>
                        - พนักงาน<br>
                        - Great Place to Work<br>
                        ยกเว้น กรณีการตักเตือนด้วยวาจา
                    </div>
                </div>
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
                    <div class="form-group">
                        <label for="suggestion" class="form-control-label">ข้อเสนอแนะ :</label>
                        <input type="text" class="form-control" id="suggestion" required>

                    </div>
                    <div class='div_modal'>
                        <div style=" border-radius: 10px;    border: 1px solid #73AD21;    padding: 10px; ">
                            <canvas id="signature-pad" class="signature-pad" width=200 height=400></canvas>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save" class="btn btn-default" data-dismiss="modal" onclick="window.open('{{URL::route('Viewform.warning',[$view_report1->user_code, $view_report1->mistake_code,$view_report1->D_devolop,$id])}}')">Save</button>
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
            var suggestion=$('#suggestion').val();

            $.ajax({

                    url : '/ajax-subcat5',
                    type: 'POST',
                    data: {id2:id2,imgBase64:data,flag:flag,mistake_code:mistake_code,user_code:user_code,suggestion:suggestion},



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
            document.getElementById("suggestion").value = '';
        });





        $('#submit_id').click(function() {
            location.reload();
        });



    </script>

@endsection
