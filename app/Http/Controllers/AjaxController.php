<?php

namespace App\Http\Controllers;

use Request;
use App\Product;

use App\User;
use App\Category;
Use App\Color;
use App\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;


class AjaxController extends Controller
{
    public function editpro()
    {
        if (Request::ajax())
        {
            $id=Request::get('id');
            $qty=Request::get('qty');
            Cart::update($id,$qty);

            return $qty;
        }
    }
    public function checkemail(){
        $email=Request::get('email');
        $user=User::where('email',$email)->get();
        if (count($user)>0)
        {
            echo "flase";
        }else
            echo 'true';
    }

    public function ajaxcate()
    {
        $id=Request::get('id');
        $data= Product::where('category_id',$id)->get();
        foreach ($data as $pro)
        {

            echo "<div class='col-12 col-sm-6 col-lg-4'>";
            echo "<div class='single-product-wrapper'>";
            echo "<div style='width: 300px' class='product-img'> <img src='http://127.0.0.1:8000/css/image/" . $pro->image . "'>";
            echo "     <div class='product-favourite'>";
            echo " <a href='#' class='favme fa fa-heart'></a>";
            echo " </div>";
            echo " </div>";
            echo " <div class='product-description'>";
            echo "<span>Tên Sản Phẩm</span>";
            echo "   <a href='single-product-details.html'></a>";
            echo "<h3>" . $pro->name . "</h3>";
            echo " <p class='product-price'><span class='old-price'></span>" . number_format($pro->price) . "&nbsp;&nbsp;NVD</p>";
            echo "<div class='hover-content'>";
            echo "<div class='add-to-cart-btn'>";
            echo "     <a href='" . route('productDetail', ['id' => $pro->id]) . "' class='btn essence-btn'>Add to Cart</a>";
            echo " </div>";
            echo " </div>";
            echo " </div>";
            echo " </div>";
            echo " </div>";
        }


    }
}
