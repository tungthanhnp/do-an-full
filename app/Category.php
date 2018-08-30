<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
  protected $table   ='category';
  protected $fillable=['id','name',];
  public function category_product()
  {
      return $this ->hasMany(Product::class,'category_id','id');
  }

}
