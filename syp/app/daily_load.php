<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daily_load extends Model
{


    protected $table = 'daily_load';
    protected $fillable = [
        'trip','trailer_no',
    ];
}
