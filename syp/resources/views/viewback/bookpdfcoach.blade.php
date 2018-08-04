
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
            font-size: 11pt;
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



        @page {

            size: 21cm 29.7cm;
            margin-top: 1cm;
            margin-bottom: 0cm;
            border: 1px solid blue;
            padding-bottom: 1px;


        }

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

        .table_dd1{
            border: 0px solid #000000;
        }

        .div_text2{
            width: 80%;
            margin: auto;
            text-align:center;
        }



        .div1 {
            float:left;
            text-align:center;
            padding: 5pt;
            display: inline-block;
        }
        .div2 {
            float:right;
            text-align:center;

            display: inline-block;
        }
        .div3 {
            float:left;
            text-align:center;
            padding: 10pt;
            display: inline-block;
        }


        .div6 {

            text-align:center;
            padding-left: 7pt;
            display: inline-block;
        }

        .div7 {


            padding-right: 0pt;

        }

        .div8 {


            padding-right: 5pt;

        }

        .picture1 {


            padding-right: 5pt;

        }



    </style>
</head>
<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>

        @foreach($mistake_code as $mistake_code2)
        <td><b>Performance Development Form – </b>{{$mistake_code2->description_mistake}}</td>
        @endforeach
        <td><div class="font_textb2"><div class="rcorners2"><img src="file:///C:/xampp/htdocs/syp/public/images/T.jpg"></div> &nbsp; Coaching (สอนงาน)</div></td>
        <td rowspan="2" align="center"><img src="file:///C:/xampp/htdocs/syp/public/images/lotus.jpg" alt="Mountain View" width="100px" ></td>
    </tr>
    @foreach($user as $view_report1)
    @endforeach

    <tr>
        <td ><div class="font_textb">แผนพัฒนาสำหรับ {{$mistake_code2->description_mistake}}</div></td>
        <td><div class="font_textb2"><div class="rcorners2"></div>  &nbsp; Development (แผนพัฒนา)</div> </td>
    </tr>
</table>
<hr>
<br>
@foreach ($user as $usere)
<table border="0" align="center"  >
    <tr>
        <td>
            <span style="border-bottom: black 1px dotted"> รหัสพนักงาน&nbsp;&nbsp;&nbsp;{{$usere->code_id}}&nbsp;&nbsp;ชื่อ&nbsp;{{$usere->fname}} {{$usere->lname}}  แผนก {{$usere->department}} วันที {{convert_date_dtos($usere->user_date)}} ระดับ<?php if ($usere->D_devolop == null){

                    echo 'สอนงาน';

                }else{
                    echo $usere->D_devolop;

                }?></span>

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
<br><br><br><br><br><br><br>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    @foreach ($user2 as $usere2)
        <tr>

            <td align="center"><div class="div6">ลงชื่อพนักงาน<img src="{{$usere->sig_trasection}}"width=180 height=60></div></td>
            <td align="center"></td>
            <td align="center"><div class="div7">ลงชื่อผู้บังคัญบัญชา<img src="{{$usere2->sig_admin}}"width=180 height=60></div></td>
        </tr>
        <tr>
            <td align="center"><div class ='div6'>{{$usere->fname}} {{$usere->lname}}</div></td>
            <td align="center"></td>
            <td align="center"><div class ='div8'>{{$usere2->zName}}</div></td>
        </tr>
        <tr>
            <td align="center"><div class ='div6'>วันที่  {{convert_date_dtos($usere->user_date)}}</div></td>
            <td align="center"></td>
            <td align="center"><div class ='div8'>วันที่  {{convert_date_dtos($usere->user_date)}}</div></td>

        </tr>
    @endforeach

</table>

@endforeach
<br>


<br><br>
<br>









<div class = "picture1">
    <table >
        <tr>  <img height="70%" width="200"class="img-circle" align="center" border="0"src="{{$usere->path_picture_Serv}}" /></tr>
    </table>
</div>

</body>
</html>