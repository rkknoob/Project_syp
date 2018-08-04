<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $username = 'user_code';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_code','name', 'email', 'password','fname','lname','department','fname_e','lname_e','status','level','name_e','name_et','created_at','data_time_work','code_id','data','work_dat','signatures','position',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function user_datatemp()
    {


        return $this->belongsTo(User::class, 'typebooks_id'); //กาํหนด FK ด้วย
    }


}
