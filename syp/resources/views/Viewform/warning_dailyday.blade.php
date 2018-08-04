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
                        <td rowspan="1"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" ></td>
                        <td> <B>บริษัท เอก - ชัย ดิสทริบิวชั่น ซิสเทม จำกัด </B></td>
                    </tr>
                </table>
            </div>
            <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>
            <input type="hidden" id='signatures' name="signatures" value="" required>
            <div class = 'div_border1'>
            <div class = 'div_text3'>
            <table border="0" align="center" width="100%" >

                @foreach($view_report as $view_report1)
                <input type="hidden" id='flag_comfirm' name="flag_comfirm" value="Y" required>

                <input type="hidden" id='signatures' name="signatures" value="" required>


                <input type="hidden" name="id2" id="id2" value="{{$id}}">

                <input type="hidden" name="user_code" id="user_code" value="{{$view_report1->user_code}}">
                <input type="hidden" name="mistake_code" id="mistake_code" value="{{$view_report1->mistake_code}}">
                    <input type="hidden" name="D_devolop" id="D_devolop" value="{{$view_report1->D_devolop}}">

                @endforeach
                <tr>
                    <br>
                    <td><b><p class="text-center"><U>หนังสือเตือน</U></p></b></td>
                </tr>
                <tr>
                    <td>หนังสือฉบับนี้ทำขึ้นที่บริษัทเอก-ชัย ดีสทริบิวชั่น ซิสเทม จำกัด เลขที่  72 หมู่ 11 ต.ท่าพระ อ.เมือง  จังหวัดขอนแก่น 13170</td>
                </tr>





                    <td><br>
                        <div class="div_text4">
                            <p>วันที่.............เดือน...............พศ...................</p></div></td>

                </tr>
            </table>
                <div class = 'div_text3'>
                <table border="0" align="center" width="100%">
                    <tr>
                        <td><p class="text-left">เรียน..{{ $view_report1->zName }}......รหัสพนักงาน...{{ $view_report1->code_id}}...ตำแหน่ง...{{ $view_report1->position}}.......แผนก...{{ $view_report1->department }}......ฝ่าย.Operation......สาขา ศูนย์กระขายสินค้าเทสโก้โลตัส สาขา ขอนแก่น</p></td>
                    </tr>

                </table>
            </div>
            <br>


                    <div class="div_text5">
                    <table border="0" align="center" width="100%">
                        <tr>
                            <td align="left">ตามที่ท่านได้กระทำผิดระเบียบข้อบังคับเกี่ยวกับการทำงานของบริษัทหมวดที่ 6 เรื่องวินัยและโทษทางวินัย </td>
                        </tr>
                        <tr>
                            <td align="left">ข้อ 1.2 ต้องปฎิบัติตามระเบียบ ข้อบังคับ ประกาศ คำสั่ง และนโยบายของบริษัท</td>
                        </tr>
                        <tr>
                            <td align="left">ข้อ 1.3 ต้องเชื่อฟังและปฎิบัติตามคำสั่งโดยชอบของผู้บังคัญบัญชาเกี่ยวกับการปฎิบัติงารและ / หรือการใช้อุปกรณ์ในการปฎิบัติงานต่าง ๆ โดยเคร่งครัด และมีสัมมาคาระวะต่อผู้บังคับบัญชา หรือผู้มีตำแหน่งสูงกว่า</td>
                        </tr>
                        <tr>
                            <td align="left">ข้อ 1.6 ต้องปฎิบัติตามกฎ ข้อบังคับและระเบียบความปลอดภัยในการทำงานอย่างเคร่งครัด</td>
                        </tr>
                        <tr>
                            <td align="left">ข้อ 2.11 ห้ามประพฤติในทางไม่เอาใจใส่ และขาดมาตราฐานในการปฎิบัติ จนทำให้บริษัทเสี่ยวต่อการสูญเสีย เสียหานทางธุรกิจ การเงิน ชื่อเสียง หรือละเลยในการปฎิบัติหน้าที่ให้ได้ตามเกณฑ์ขั้นต่ำในนการผลิต หรือคุณภาพ</td>
                        </tr>
                    </table>




                    </div>
                <br>
                <div class="table-responsive">
                    <table border="0" align="center" width="80%">
                        <tr>
                            <td align="left">ซึ่งมีรายละเอียดดังต่อไปนี้  กล่าวคือ......................{{$view_report1->description}}...........................................   </td>
                        </tr>
                    </table>
                </div>

                <br>
                <br>
                <br>



                <table border="0" align="center" width="80%">
                    <tr>
                        <td align="left">จึงเห็นสมควร </td>
                        <td>[.....] </td>
                        <td align="left">ตักเตือนด้วยวาจา </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>[.....] </td>
                        <td align="left">ตักเตือนเป็นลายลักษณ์อักษร </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>[.....] </td>
                        <td align="left">ตักเตือนเป็นลายลักษณ์อักษร และพักงานโดยไม่จ่ายค่าจ้าง เป็นระยะเวลา .........วันทำงาน</td>

                    </tr>


                    <tr>
                        <td></td>
                        <td></td>
                        <td align="left">คือตั้งแต่วันที่ ..................... จนถึงวันที่ ........................</td>

                    </tr>

                </table>

                <table border="0" align="center" width="100%">
                    <tr>
                        <td align="center">บริษัทขอเตือนให้ท่านประพฤติปฏิบัติตามระเบียบข้อบังคับของบริษัท โดยเคร่งครัด และแก้ไขปรับปรุงตนให้ดีขึ้น  </td>
                   </tr>
                    <tr>
                        <td align="left">หากปรากฎว่าท่านยังคงประพฤติปฎิบัติผิดระเบียบข้อบังคับของบริษัท ในข้อดังกล่าวหรือในข้ออื่นๆ อีก บริษัทจะพิจารณาลงโทษทางวินัยสถานหนักขึ้นตามขอบังคับต่อไป </td>
                    </tr>


                </table>
                <br>
            <div class="div_text4">
                <table border="0" align="center" width="50%">
                    <tr>
                        <td align="left">ลงชื่อ.......................................................ผู้บังคับบัญชา </td>
                    </tr>
                    <tr>
                        <td align="left">(...........................................................................) </td>
                    </tr>
                    <tr>
                        <td align="left">ตำแหน่ง.............................................................. </td>
                    </tr>
                 </table>
            </div>
                <br>

                <table border="0" align="center" width="80%">
                    <tr>
                        <td align="left">ลงชื่อ.......................................................ผู้บังคับบัญชา </td>
                        <td align="left">ลงชื่อ.......................................................ผู้บังคับบัญชา </td>
                    </tr>
                    <tr>
                        <td align="left">(...........................................................................) </td>
                        <td align="left">(...........................................................................) </td>
                    </tr>

                </table>


            <br>

                <table border="2" class="div_table" width="100%" >

                    <tr>
                        <td align="left" class="div_textlast" ><B><U>พนักงานรับทราบ</U></B></td>
                        <td align="left" class="div_textlast"><B><U>ฝ่ายบุคคล </U></B></td>
                        <td align="left" class="div_textlast"><B><U>1.ต้นฉบับ</U></B></td>
                    </tr>
                    <tr>
                        <td align="left"class="div_textlast">ลงชื่อ.......................................................</td>
                        <td align="left"class="div_textlast">ลงชื่อ.......................................................</td>
                        <td align="left"class="div_textlast"> - เก็บเข้าแฟ้มประวัติพนักงาน</td>
                    </tr>
                    <tr>
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.......................................................)</td>
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.......................................................)</td>
                        <td align="left"class="div_textlast"><B><U>2. สำเนา</U></B></td>
                    </tr>
                    <tr>
                        <td align="left">&nbsp;&nbsp;&nbsp;ตำแหน่ง....................................................)</td>
                        <td align="left">&nbsp;&nbsp;&nbsp;ตำแหน่ง....................................................)</td>
                        <td align="left"class="div_textlast">- พนักงาน</td>
                    </tr>
                    <tr>
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่....................................................</td>
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่....................................................</td>
                        <td align="left"class="div_textlast">- Great Place to Work</td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td align="left"class="div_textlast">ยกเว้น กรณีการตักเตือนด้วยวาจา</td>
                    </tr>




                </table>
            </div>
            </div>
        </form>


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
                        setTimeout(function(){  window.location = '{{route('workdaily.index')}}'; }, 1000);


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
