<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datatemp extends Model
{

    protected $table = 'datatemp';
    public static $key = 'id';

    protected $fillable = [
        'id','document_date1','user_code','date_work','detail'
    ];
}
