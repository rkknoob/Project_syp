<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_transection extends Model
{

    protected $table = 'tb_transection';

    public static $key = 'No';
    protected $casts = [
        'width' => 'integer',
    ];

    protected $fillable = [
        'No','mistake_code','description', 'user_code', 'user_date','user_login','type_warning','warning_status','path_picture','path_picture_Serv','flag_print','st_date_dev','rkknoob','signatures','flag_comfirm','D_devolop','code_id','id','devolop_plan','timlength','mistake_type','date_review','suggestion','id_temp',
    ];



}
