<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_mistake extends Model
{

    protected $table = 'tb_mistake';
    public static $key = 'mistake_code';

    protected $fillable = [
        'mistake_code','description_mistake','cnt_alert','warning_flag','updated_at','created_at','group_department',
    ];
}
