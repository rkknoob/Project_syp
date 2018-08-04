<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolop extends Model
{
    protected $fillable = [
        'mistake_code','description', 'user_code', 'user_date','user_login','type_warning','warning_status','image','rkknoob',
    ];

}
