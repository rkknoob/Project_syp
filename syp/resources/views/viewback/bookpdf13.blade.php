
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
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
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

</head>
<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td><div class="font_textb">Performance Development Form – Performance</div></td>
        <td><div class="font_textb2"><div class="rcorners2"></div> &nbsp; Coaching (สอนงาน)</div></td>
        <td rowspan="2" align="center"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" width="100px" ></td>
    </tr>


    <tr>
        <td ><div class="font_textb">แผนพัฒนาสำหรับ การปฏิบัติงานให้ได้ตามเป้าหมาย</div></td>
        <td><div class="font_textb2"><div class="rcorners2"></div> &nbsp; Development (แผนพัฒนา)</div> </td>
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
    <tr>
        <td>1. ทราบมาตรฐานของเป้าหมายคลังสินค้า ในแต่ละหน้างานที่รับผิดชอบ</td>
        <td>1. ติดตามผลการทำงานของตัวเองเทียบกับเป้าหมายที่กำหนดไว้อย่างสม่ำเสมอ</td>

    </tr>
    <tr>
        <td>2. ผ่านการอบรม เทคนิคการเพิ่มประสิทธิภาพในการทำงานของของแต่ละแผนก</td>
        <td>2. ปฏิบัติตาม เทคนิค ขั้นตอน และวิธีการทำงานอย่างเต็มประสิทธิภาพ</td>
    </tr>
    <tr>
        <td>2. ผ่านการอบรม เทคนิคการเพิ่มประสิทธิภาพในการทำงานของของแต่ละแผนก</td>
        <td>2. ปฏิบัติตาม เทคนิค ขั้นตอน และวิธีการทำงานอย่างเต็มประสิทธิภาพ</td>
    </tr>
    <tr>
        <td>3. สามารถวางแผนการทำงานเพื่อให้บรรลุได้ตามเป้าหมาย</td>
        <td>3. ต้องปฏิบัติงานให้ได้ตามเป้าหมาย ในแต่ละหน้าที่ ตามที่บริษัทกำหนดไว้</td>
    </tr>
    <tr>
        <td>4. ทราบบทลงโทษ ในกรณีที่พนักงานไม่สามารถปฎิบัติงานได้ตามเป้าหมายได้</td>
        <td>4. ต้องแจ้งหัวหน้างานหรือผู้เกี่ยวข้องทราบทันที หากพบปัญหาในการทำงาน</td>
    </tr>

    <tr>
        <td>5. ทราบถึงวิธีการแก้ไขปัญหาหน้างาน และต้องแจ้งหัวหน้างานทันทีที่เกิดปัญหา</td>
        <td></td>
    </tr>


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

            <img src="{{$usere->signatures}}"width=200 height=60>
            <br>{{$usere->zName}}</br>
            <br> วันที่  {{convert_date_dtos($usere->user_date)}}</br>


        </div>






        @endforeach
        @endforeach
    </tr>


</table>



</body>
</html>