

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


        <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';

            src: url({{storage_path().'/fonts/THSarabunNew.eot'}});
            src: url({{storage_path().'/fonts/THSarabunNew.woff'}}) format('woff'),
            url({{storage_path().'/fonts/THSarabunNew.ttf'}})format('truetype'),
            url({{storage_path().'/fonts/THSarabunNew.svg'}})format('svg');
            font-style: normal;
            font-weight: normal;
        }

        @font-face {
            font-family: 'THSarabunNew';

            src: url({{storage_path().'/fonts/THSarabunNew.eot'}});
            src: url({{storage_path().'/fonts/THSarabunNew.woff'}}) format('woff'),
            url({{storage_path().'/fonts/THSarabunNew.ttf'}})format('truetype'),
            url({{storage_path().'/fonts/THSarabunNew.svg'}})format('svg');
            font-style: normal;
            font-weight: bold;
        }
        body {

            font-family: 'THSarabunNew',Sans-Serif;
            font-size: 12pt;
        }
        .text_size{
            font-size: 25px;
        }

        .nsme_user{
            text-align: center;
        }

        .font_textb{
            font-size: 12pt;
            padding-left: 150px;

        }


        .font_textb2{
            padding-left: 80px;
            font-size: 10pt;
        }


        .font_textb11{
            padding-left: 100px;

        }


        .font_textb3{
            font-size: 12pt;
            padding-left: 155px;
        }
        hr{
            width: 100%;
        }



        @page { sheet-size: A3-L; }

        @page bigger { sheet-size: 420mm 370mm; }

        @page toc { sheet-size: A4; }

        h1.bigsection {
            page-break-before: always;
            page: bigger;
        }


        .rcorners2 {
            border: 2px solid #000000;
            width: 15px;
            height: 15px;
            position: absolute;
            float:left;
            top:5px;
        }

        .table_dd td{
            border: 5px solid #000000;
        }



        .table_test{
            border: 0px solid #000000;
            margin-top: -20px;

        }


        .table_test2{
            border: 5px solid #000000;


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
            float:right;
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

        .div_border1 {
            border-style: solid;

            width: 100%;

        }

        .div_text{
            width: 100%;
            margin: auto;
            font-size: 5px;

        }  .div_head{
               text-decoration:underline;
           }


        .div_td {
            padding-left: 20px;

        }

        .div_td2 {
            padding-right: 20px;

        }

        .div_font{
            font-weight:bold;

        }

        u.dotted{
            border-bottom: 1px dashed #999;
            text-decoration: none;
        }



    </style>
</head>
<body>

<table width="100%" border="0" align="center" class="table_test" cellpadding="0" cellspacing="0">
    <tr>

        <td rowspan="1" align="center"><img src="file:///C:/xampp/htdocs/syp/public/images/lotus.jpg" alt="Mountain View" width="50px" ></td>
        <td  rowspan="1" ><div class="font_textb">บริษัท เอก - ชัย ดิสทริบิวชั่น ซิสเทม จำกัด </div></td>
    </tr>



</table>
<br>
<table border="5"   class="table_test" align="center"   width="100%" >
    <tr><td colspan="3">


            <table border="0"  align="center"  width="100%">
                <tr> <td align="center"><b><h3>หนังสือเตือน </h3></b></td> </tr>
                <tr> <td align="center"> หนังสือฉบับนี้ทำขึ้นที่บริษัทเอก-ชัย ดีสทริบิวชั่น ซิสเทม จำกัด เลขที่  72 หมู่ 11 ต.ท่าพระ อ.เมือง  จังหวัดขอนแก่น 13170 </td> </tr>
                @foreach ($user as $usere)
                <tr> <td align="right"> {{ convert_date_StoTh2(convert_date_dtos($usere->user_date)) }}</td> </tr>

                    <tr> <td align="left"> เรียน....{{$usere->zName}}....รหัสพนักงาน..........&nbsp;{{$usere->code_id}}.............ตำแหน่ง...{{$usere->position}}.......แผนก....{{$usere->department}}.....ฝ่าย.Operation...{{$usere->D_devolop}}...

                        </td> </tr>
                    <tr> <td align="left">สาขา ศูนย์กระขายสินค้าเทสโก้โลตัส สาขา ขอนแก่น</td> </tr>
                    <tr> <td align="left"><div class="font_textb2">ตามที่ท่านได้กระทำผิดระเบียบข้อบังคับเกี่ยวกับการทำงานของบริษัท {{$group}}เรื่องวินัยและโทษทางวินัย</div></td> </tr>

                    @foreach ($type_basic_warning as $type_basic_warning2)

                        <tr> <td align="left"><div class="font_textb">{{$type_basic_warning2->basic_type}}</div></td> </tr>

                    @endforeach
                    <tr><td>

                    @if ($usere->D_devolop == 'V')
                        <tr> <td align="left"><div class="font_textb3"> <img src="file:///C:/xampp/htdocs/syp/public/images/T.jpg">ตักเตือนด้วยวาจา</div></td></tr>
                        <tr> <td align="left"><div class="font_textb3"> [.......]ตักเตือนเป็นลายลักษณ์อักษร</div></td></tr>
                        <tr> <td align="left"><div class="font_textb3"> [.......]ตักเตือนเป็นลายลักษณ์อักษร และพักงานโดยไม่จ่ายค่าจ้าง เป็นระยะเวลา .........วันทำงาน</div></td> </tr>


                    @elseif($usere->D_devolop == 'W')





                        <tr> <td align="left"><div class="font_textb11">จึงเห็นสมควร [.......]ตักเตือนด้วยวาจา</div></td> </tr>
                        <tr> <td align="left"><div class="font_textb3">  <img src="file:///C:/xampp/htdocs/syp/public/images/T.jpg">ตักเตือนเป็นลายลักษณ์อักษร</div></td></tr>

                        <tr> <td align="left"><div class="font_textb3"> [.......]ตักเตือนเป็นลายลักษณ์อักษร และพักงานโดยไม่จ่ายค่าจ้าง เป็นระยะเวลา .........วันทำงาน</div></td> </tr>


                    @elseif($usere->D_devolop == 'TM')


                        <tr> <td align="left"><div class="font_textb11">จึงเห็นสมควร [.......]ตักเตือนด้วยวาจา</div></td> </tr>
                        <tr> <td align="left"><div class="font_textb3"> [.......]ตักเตือนเป็นลายลักษณ์อักษร</div></td></tr>
                        <tr> <td align="left"><div class="font_textb3"> <img src="file:///C:/xampp/htdocs/syp/public/images/T.jpg">ตักเตือนเป็นลายลักษณ์อักษร และพักงานโดยไม่จ่ายค่าจ้าง เป็นระยะเวลา .........วันทำงาน</div></td> </tr>


                        @endif
                        </td></tr>

                        <tr> <td align="left"><div class="font_textb3"> คือตั้งแต่วันที่..........................จนถึงวันที่........................</div></td> </tr>
                        <tr> <td align="left"><div class="font_textb2"> บริษัทขอเตือนให้ท่านประพฤติปฏิบัติตามระเบียบข้อบังคับของบริษัท โดยเคร่งครัด และแก้ไขปรับปรุงตนให้ดีขึ้นหากปรากฎว่าท่านยังคงประพฤติปฎิบัติผิดระเบียบข้อบังคับของบริษัท</div></td> </tr>
                        <tr> <td align="left"> ในข้อดังกล่าวหรือในข้ออื่นๆ อีก บริษัทจะพิจารณาลงโทษทางวินัยสถานหนักขึ้นตามขอบังคับต่อไป</td> </tr>



                        @endforeach


                        @foreach ($user2 as $usere2)
                            <tr> <td class ="div_td" align="center">ลงชื่อ...................................................ผู้บังคับบัญชา</td> </tr>
                            <tr> <td class ="div_td2" align="center">{{$usere2->zName}}</td> </tr>
                            <tr> <td class ="div_td2" align="center">ตำแหน่ง{{$usere2->position}}</td> </tr>
                        @endforeach


                        <tr> <td> <table border="0"  align="center"  width="100%" >
                                    <tr><td>ลงชื่อ.........................................พยาน</td><td style="padding-left: 370px;" >ลงชื่อ.........................................พยาน<</td></tr>
                                    <tr><td>(....................................................)</td><td style="padding-left: 375px;">(...................................................)</td></tr>

                                </table>
                            </td> </tr>



            </table>



    <tr>
        <td><table border="0"  align="center"  width="100%">
                <tr><td>พนักงาน</td></tr>
                <tr><td>ลงชื่อ....................................................................</td></tr>
                <tr><td><u class ='dotted'>({{$usere->zName}})</u></td></tr>
                <tr><td >ตำแหน่ง<u class ='dotted'> {{$usere->position}}</u></td></tr>
                <tr><td>วันที..................../................../..........................</td></tr>

            </table></td>
        <td><table border="0"  align="center"  width="100%" >
                <tr><td>ฝ่ายบุคคล</td>/tr>
                <tr><td>ลงชื่อ.................................................................</td>/tr>
                <tr><td>(...........................................................................)</td>/tr>
                <tr><td>ตำแหน่ง........................................................................</td>/tr>
                <tr><td>วันที..................../................../..........................</td>/tr>

            </table></td>
        <td><table border="0"  align="center"  width="100%" >
                <tr><td>1.ต้นฉบับ</td>/tr>
                <tr><td> - เก็บประวัติพนักงานเข้าแฟ้ม</td>/tr>
                <tr><td>2.สำเนา</td>/tr>
                <tr><td> - พนักงาน</td></tr>
                <tr><td></td></tr>

            </table></td>
    </tr>



    </td>




    </tr>



    <table class="table_test">



        <tr>  <img height="200%" width="200"class="img-circle" src="{{$usere->path_picture_Serv}}" /></tr>




    </table>




</table>









</body>
</html>