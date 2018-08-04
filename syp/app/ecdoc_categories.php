<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ecdoc_categories extends Model
{
    protected $table = 'ecdoc_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','description',
    ];
}
