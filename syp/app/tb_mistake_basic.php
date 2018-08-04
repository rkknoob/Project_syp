<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_mistake_basic extends Model
{
    protected $fillable = [
        'mistake_code','basic', 'attention'
    ];
}
