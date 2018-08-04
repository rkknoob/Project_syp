<?php
//แปลงวันที่ เดือน-วัน ชั่วโมง:นาที
function convert_date($temp_date){
    $date_temp = date_create($temp_date);
    return  date_format($date_temp, 'm-d H:i');
}


?>