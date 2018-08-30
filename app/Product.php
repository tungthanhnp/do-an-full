<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Productimage;
use App\Order;
use App\Color;
use App\Size;
class Product extends Model
{
    protected $table   ='product';
    protected $fillable=['id','name','price','image','size','color','category_id'];
    public function product_category()
    {
        return $this -> belongsTo(Category::class,'category_id','id');
    }
    public function product_productimage()
    {
        return $this -> hasMany(Productimage::class,'product_id','id');
    }
    public function product_order()
    {
        return $this->hasMany(Order::class,'product_id','id');
    }
    public function product_color()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }
    public function product_size()
    {

        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }
}
