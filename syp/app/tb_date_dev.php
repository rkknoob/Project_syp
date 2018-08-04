<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_date_dev extends Model
{
    protected $table = 'tb_date_dev';


    protected $fillable = [
        'st_date_dev','en_date_dev',
    ];
}
