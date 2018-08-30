<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Order;

class User extends Authenticatable
{
    use Notifiable;

    protected $table    ='users';
    protected $fillable = [
        'id','name', 'email', 'password','address','phone','lever'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];
    public function user_order()
    {
        return $this->hasMany(Order::class,'user_id','id');
    }
}
