<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table   ='orders';
    protected $fillable=['id','name','status','user_id'];
    public function order_user()
    {
        return $this -> belongsTo(User::class,'user_id','id');
    }
    public function order_product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
