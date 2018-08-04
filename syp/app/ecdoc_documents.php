<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ecdoc_documents extends Model
{
    protected $table = 'ecdoc_documents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id','document_code','register_date','reference','topic','register_date','store','filename','description','created_date','created_by','categorie_id',
    ];
}
