
<?php //print_r($data)

function convert_date_dtos($temp_date){
    $date_temp = date_create($temp_date); //ใช้ใน php เวอร์ชั่น 2.6
    //$date_temp = $temp_date;
    $temp = explode("/",(date_format($date_temp, 'd/m/Y')));
    return date($temp['0'])."/".date($temp['1'])."/".date($temp['2']+543);
}



?>


        <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <style>
        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{storage_path('fonts/THSarabun.ttf')}}") format('truetype');
        }
        body {

            font-family: "THSarabun";
            font-size: 12pt;
        }
        .text_size{
            font-size: 25px;
        }

        .nsme_user{
            text-align: center;
        }

        .font_textb{
            font-size: 16pt;
        }

        .font_textb2{
            font-size: 14pt;
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
            border: 1px solid #000000;
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



    </style>
</head>
<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>

        @foreach($user as $view_report1)
            <td><?php
                if ($view_report1->mistake_code == '01'){

                    echo '  <b>Performance Development Form – Accident by human</b>';
                } else if ($view_report1->mistake_code == '02'){

                    echo '  <b>Performance Development Form – Accident by rack</b>';

                } else if ($view_report1->mistake_code == '03'){


                    echo '  <b>Performance Development Form – Accident by product</b>';
                } else if ($view_report1->mistake_code == '04'){


                    echo '  <b>Performance Development Form –  Late</b>';
                }
                else if ($view_report1->mistake_code == '05'){


                    echo '  <b>Performance Development Form – Over Break</b>';
                }
                else if ($view_report1->mistake_code == '06'){


                    echo '  <b>Performance Development Form – RF & Key</b>';
                }
                else if ($view_report1->mistake_code == '07'){


                    echo '  <b>Performance Development Form – RF & Key</b>';
                }
                else if ($view_report1->mistake_code == '08'){


                    echo '  <b>Performance Development Form – Cancel Pick</b>';
                }
                else if ($view_report1->mistake_code == '09'){


                    echo '  <b>Performance Development Form – BoL Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '10'){


                    echo '  <b>Performance Development Form – Replenishment & Putaway</b>';
                }
                else if ($view_report1->mistake_code == '11'){


                    echo '  <b>Performance Development Form – Receiving Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '12'){


                    echo '  <b>Performance Development Form – Shipping Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '13'){


                    echo '  <b>Performance Development Form – Un-manifest</b>';
                }
                else if ($view_report1->mistake_code == '14'){


                    echo '  <b>Performance Development Form – Cube Load</b>';
                }
                else if ($view_report1->mistake_code == '15'){


                    echo '  <b>Performance Development Form – Not Scan JA</b>';
                }
                else if ($view_report1->mistake_code == '16'){


                    echo '  <b>Performance Development Form – Performance</b>';
                }
                else if ($view_report1->mistake_code == '17'){


                    echo '  <b>Performance Development Form – Absent</b>';
                } else if ($view_report1->mistake_code == '18'){


                    echo '  <b>Performance Development Form – Quick Lunch</b>';
                }
                else if ($view_report1->mistake_code == '19'){


                    echo '  <b>Performance Development Form – Code 55</b>';
                }
                else if ($view_report1->mistake_code == '20'){


                    echo '  <b>Performance Development Form – Skip F7</b>';
                }

                else if ($view_report1->mistake_code == '21'){


                    echo '  <b>Performance Development Report SYP Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '22'){


                    echo '  <b>Performance Development Form – Report Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '23'){


                    echo '  <b>Performance Development Form – Inventory Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '24'){


                    echo '  <b>Performance Development Form – Report Progress Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '25'){


                    echo '  <b>Performance Development Form – Confirm Location</b>';
                }
                else if ($view_report1->mistake_code == '26'){


                    echo '  <b>Performance Development Form – Not Confirm Y</b>';
                }
                else if ($view_report1->mistake_code == '27'){


                    echo '  <b>Performance Development Form – Picking Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '28'){


                    echo '  <b>Performance Development Form – Equipment Accuracy</b>';
                }
                else if ($view_report1->mistake_code == '29'){


                    echo '  <b>Performance Development Form – ไม่ปฏิบัติด้านความปลอดภัย</b>';
                }
                else if ($view_report1->mistake_code == '30'){


                    echo '  <b>Performance Development Form – ฝ่าฝืนกฏระเบียบ</b>';
                }
                else if ($view_report1->mistake_code == '31'){


                    echo '  <b>Performance Development Form – Not Reflective Shirt</b>';
                }

                else if ($view_report1->mistake_code == '31'){


                    echo '  <b>Performance Development Form – Inbound Accuracy</b>';
                }else {

                    echo '  <b>Performance Development Form – ไม่มี</b>';

                }

                ?></td>
        @endforeach
        <td><div class="font_textb2"><div class="rcorners2"></div> &nbsp; Coaching (สอนงาน)</div></td>
        <td rowspan="2" align="center"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" width="100px" ></td>
    </tr>


    <tr>
        <td ><div class="font_textb">แผนพัฒนาสำหรับ การปฏิบัติงานให้ได้ตามเป้าหมาย</div></td>
        <td><div class="font_textb2"><div class="rcorners2"></div>  &nbsp; Development (แผนพัฒนา)</div> </td>
    </tr>
</table>
<hr>
<br>
@foreach ($user as $usere)
    <table border="0" align="center"  >
        <tr>
            <td>
                <span style="border-bottom: black 1px dotted"> รหัสพนักงาน&nbsp;&nbsp;&nbsp;{{$usere->code_id}}&nbsp;&nbsp;ชื่อ&nbsp;{{$usere->zName}}  แผนก {{$usere->department}} วันที {{convert_date_dtos($usere->user_date)}} ระดับ {{$usere->D_devolop}}</span>



            </td>
        </tr>
    </table>



    <table  align="center"  width="100%" cellpadding="0" cellspacing="0" class="table_dd">
        <tr>
            <td align="center">ทักษะที่จำเป็น</td>
            <td align="center">ความใส่ใจที่จำเป็น</td>
        </tr>


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


    <table border="0" align="center" width="100%">
        <tr>
            <td>
                สิ่งที่ต้องปรับปรุงและพัฒนาให้ถูกต้องในการทำงาน
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0" class="table_dd">
        <tr>
            <td align="center">ข้อผิดพลาดที่พบ</td>
            <td align="center">แผนการปรับปรุงและพัฒนา</td>
            <td align="center">ระยะเวลา</td>
            <td align="center"> วันที่ทบทวน</td>
            <td align="center">ผลการปรับปรุง</td>
        </tr>
        <tr>devolop_plan
            <td align="center">{{$usere->mistake_description}}</td>
            <td align="center">{{$usere->devolop_plan}}</td>
            <td align="center"><?php if ($usere->timlength == '1'){

                    echo ' ทันที';

                }else if ($usere->timlength == '2'){

                    echo ' 1 วัน';
                }else if($usere->timlength == '3'){
                    echo ' 3 วัน';

                }else if($usere->timlength == '4'){
                    echo ' 5 วัน';

                }else if($usere->timlength == '5'){
                    echo ' 1 สัปดาห์';

                }?></td>
            <td align="center">{{$view_report1->date_review}}</td>
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
    <table border="0" align="center" width="100%">
        <tr>
            <td>
                ท่านต้องการให้หัวหน้างานช่วยเหลืออย่างไรบ้าง………………………………………………………………………………………………………………………………………………………
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอสัญญาว่า จะนำแผนการพัฒนาไปปฏิบัติตามอย่างเคร่งครัด และรายงานผลให้หัวหน้าทราบ ซึ่งข้าพเจ้าทราบดีว่า แผนพัฒนานี้ มีเจตนามุ่งหวังที่จะช่วยท่าน<br>ในการปรับปรุง พฤติกรรมการทำงานให้เป็นไปตามระเบียบข้อบังคับที่บริษัทฯ
                กำหนด โดยยังไม่ใช่การลงโทษทางวินัย โดยยังไม่ใช่การลงโทษทางวินัย  หากข้าพเจ้า<br>ยังไม่มีการปรับปรุง จะถูกดำเนินการทางวินัยต่อไป
            </td>
        </tr>
    </table>
    <br><br><br>
    <table border="0" align="center" width="10%">
        @foreach ($user2 as $usere2)
            <div class='div2'>
                <img src="{{$usere2->sig_admin}}"width=200 height=60>
                <br>  {{$usere2->zName}}</br>
                <br> วันที่  {{convert_date_dtos($usere->user_date)}}</br>


            </div>
            <div class='div1'>

                <img src="{{$usere->sig_trasection}}"width=200 height=60>
                <br>{{$usere->zName}}</br>
                <br> วันที่  {{convert_date_dtos($usere->user_date)}}</br>


            </div>






            @endforeach
            @endforeach
            </tr>


    </table>



</body>
</html>