<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Productimage extends Model
{
    protected $table   ='productimage';
    protected $fillable=['id','name','product_id'];
    public function productimgage_product()
    {
        return $this -> belongsTo(Product::class,'product_id','id');
    }
}
