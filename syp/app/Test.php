<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use Notifiable;
    protected $username = 'user_code';

    protected $fillable = [
        'id','user_code','name', 'email', 'password','fname','lname','department','fname_e','lname_e','status','level','name_e','name_et',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
