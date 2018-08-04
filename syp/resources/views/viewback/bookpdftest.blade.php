
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
            font-size: 12pt;
            padding-left: 150px;

        }


        .font_textb2{
            padding-left: 80px;
            font-size: 10pt;
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



    </style>
</head>
<body>

<table width="100%" border="0" align="center" class="table_test" cellpadding="0" cellspacing="0">
    <tr>
        <td rowspan="1" align="center"><img src="{!!asset('images/lotus.png')!!}" alt="Mountain View" width="50px" ></td>
        <td  rowspan="1" ><div class="font_textb">บริษัท เอก - ชัย ดิสทริบิวชั่น ซิสเทม จำกัด </div></td>
    </tr>



</table>
<br>
<table border="5"   class="table_test" align="center"   width="100%" >
  <tr><td colspan="3">


          <table border="0"  align="center"  width="100%">
              <tr> <td align="center"> หนังสือเตือน </td> </tr>
              <tr> <td align="center"> หนังสือฉบับนี้ทำขึ้นที่บริษัทเอก-ชัย ดีสทริบิวชั่น ซิสเทม จำกัด เลขที่  72 หมู่ 11 ต.ท่าพระ อ.เมือง  จังหวัดขอนแก่น 13170 </td> </tr>
              <tr> <td align="right"> วันที่.............เดือน...............พศ................... </td> </tr>
              <tr> <td align="left"> เรียน........รหัสพนักงาน....................................................dsfsdfsdfdfdasdasdasdadasdasdsd..ตำแหน่ง..........แผนก.........ฝ่าย.Operation......สาขา ศูนย์กระขายสินค้าเทสโก้โลตัส สาขา ขอนแก่น </td> </tr>
              <tr> <td align="left"><div class="font_textb2">ตามที่ท่านได้กระทำผิดระเบียบข้อบังคับเกี่ยวกับการทำงานของบริษัทหมวดที่ 6 เรื่องวินัยและโทษทางวินัย</div></td> </tr>
              <tr> <td align="left"><div class="font_textb">ข้อ 1.2 ต้องปฎิบัติตามระเบียบ ข้อบังคับ ประกาศ คำสั่ง และนโยบายของบริษัท</div></td> </tr>
              <tr> <td align="left"><div class="font_textb">ข้อ 1.3 ต้องเชื่อฟังและปฎิบัติตามคำสั่งโดยชอบของผู้บังคัญบัญชาเกี่ยวกับการปฎิบัติงารและ / หรือการใช้อุปกรณ์ในการปฎิบัติงานต่าง ๆ โดยเคร่งครัด และมีสัมมาคาระวะต่อผู้บังคับบัญชา หรือผู้มีตำแหน่งสูงกว่า</div></td> </tr>
              <tr> <td align="left"><div class="font_textb">ข้อ 1.6 ต้องปฎิบัติตามกฎ ข้อบังคับและระเบียบความปลอดภัยในการทำงานอย่างเคร่งครัด</div></td> </tr>
              <tr> <td align="left"><div class="font_textb">ข้อ 2.11 ห้ามประพฤติในทางไม่เอาใจใส่ และขาดมาตราฐานในการปฎิบัติ จนทำให้บริษัทเสี่ยวต่อการสูญเสีย เสียหานทางธุรกิจ การเงิน ชื่อเสียง หรือละเลยในการปฎิบัติหน้าที่ให้ได้ตามเกณฑ์ขั้นต่ำในนการผลิต หรือคุณภาพ</div></td> </tr>
              <tr> <td align="left"><div class="font_textb2">ซึ่งมีรายละเอียดดังต่อไปนี้  กล่าวคือ.........................................................................................</div></td> </tr>
              <tr> <td align="left"><div class="font_textb2">จากการกระทำพฤติกรรมดังกล่าวของท่านก่อให้เกิดความเสียหายต่อหน่วยงานของบริษัทคือ ส่งผลกระทบต่อการบริหารงานในแผนก</div></td> </tr>
              <tr> <td align="left"><div class="font_textb2">จึงเห็นสมควร [.......]ตักเตือนด้วยวาจา</div></td> </tr>
              <tr> <td align="left"><div class="font_textb3"> [.......]ตักเตือนเป็นลายลักษณ์อักษร</div></td> </tr>
              <tr> <td align="left"><div class="font_textb3"> [.......]ตักเตือนเป็นลายลักษณ์อักษร และพักงานโดยไม่จ่ายค่าจ้าง เป็นระยะเวลา .........วันทำงาน</div></td> </tr>
              <tr> <td align="left"><div class="font_textb3"> คือตั้งแต่วันที่..........................จนถึงวันที่........................</div></td> </tr>
              <tr> <td align="left"><div class="font_textb2"> บริษัทขอเตือนให้ท่านประพฤติปฏิบัติตามระเบียบข้อบังคับของบริษัท โดยเคร่งครัด และแก้ไขปรับปรุงตนให้ดีขึ้นหากปรากฎว่าท่านยังคงประพฤติปฎิบัติผิดระเบียบข้อบังคับของบริษัท</div></td> </tr>
              <tr> <td align="left"> ในข้อดังกล่าวหรือในข้ออื่นๆ อีก บริษัทจะพิจารณาลงโทษทางวินัยสถานหนักขึ้นตามขอบังคับต่อไป</td> </tr>

              <tr> <td align="center">ลงชื่อ.........................................ผู้บังคับบัญชา</td> </tr>
              <tr> <td align="center">(...............................................)</td> </tr>
              <tr> <td align="center">ตำแหน่ง.........................................</td> </tr>


              <tr> <td> <table border="0"  align="center"  width="100%" >
                          <tr><td>ลงชื่อ.........................................พยาน</td><td style="padding-left: 200px;" >ลงชื่อ.........................................พยาน<</td></tr>
                          <tr><td>(....................................................)</td><td style="padding-left: 200px;">(...................................................)</td></tr>

                      </table>
                  </td> </tr>




          </table>



    <tr>
        <td><table border="0"  align="center"  width="100%" >
                <tr><td>พนักงาน</td>/tr>
                <tr><td>ลงชื่อ.................................................................พยาน</td>/tr>
                <tr><td>(...........................................................................)</td>/tr>
                <tr><td>ตำแหน่ง.......................................................................</td>/tr>
                <tr><td>วันที..................../................../..........................</td>/tr>

            </table></td>
        <td><table border="0"  align="center"  width="100%" >
                <tr><td>ฝ่ายบุคคล</td>/tr>
                <tr><td>ลงชื่อ.................................................................พยาน</td>/tr>
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




</table>





</body>
</html>