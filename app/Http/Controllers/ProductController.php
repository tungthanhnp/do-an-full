<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Productimage;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Color;
use App\Size;


class ProductController extends Controller
{
    //thêm product
    public function getThem()
    {
        $color=Color::all();
        $cate =Category::all();
        $size =Size::all();
        return view('backend.product.addProduct',['colors'=>$color,'cates'=>$cate,'sizes'=>$size]);
    }


    //listpeoduct
    public function getdanhSach()
    {
        $data=Product::paginate(10);
        return view('backend.product.listProduct',['data'=>$data]);
    }
    //addpro
    public function postThem(Request $request)
    {
        $data  = ($request->all());
        $relus =
            [
                'name'  => 'required|min:2|unique:product,name',
                'price' => 'required|numeric',
                'image' => 'required | mimes:jpeg,jpg,png, | max:10000',
                'color' => 'required',
                'size'  => 'required'
            ];
        $messages =
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute bạn phải nhập ít nhât là :min kí tự',
                'numeric' => ':attribute định dạng số',
                'unique' => ' Tên đã tồn tại',
                'mimes' => 'file bạn đưa lên không phải định dạng file ảnh'
            ];
        $customAttribute =
            [
                'name'  => 'Tên',
                'price' => 'Giá Tiên',
                'color' => 'Màu sản Phẩm',
                'size'  => 'kich cỡ'
            ];

        $validate = Validator::make($data, $relus, $messages, $customAttribute);
        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category;

        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $hinh = str_random(5) . '.' . $name;

        while (file_exists('css/image' . $hinh))
        {
            $hinh = str_random(5) . '.' . $name;
        }

        $file->move('css/image/', $hinh);
        $product->image = $hinh;
        $product->save();



        /*return redirect()->route('danhSachUser')->with('thongbaothanhcong','bạn đã tao mới thành công');*/

        if (Input::hasFile('imagepro')) {

            foreach (Input::file('imagepro') as $file) {

                $name=$file->getClientOriginalExtension();
                if ($name == 'png' || $name == 'jpg' || $name =='jpeg' || $name =='PNG' || $name =='JPG' || $name =='JPEG')
                {
                    $proimg = new Productimage();
                    if (isset($file))
                    {
                        $proimg->product_id = $product->id;
                        $file  ->move('css/image_detail/',$file->getClientOriginalName());
                        $proimg->name = $file->getClientOriginalName();
                        $proimg->save();
                    }

                } else

                    echo 'file đưa lên không đúng định dạng đuôi ảnh';
            }

        } else {
            echo 'chưa có file';
        }

        foreach ($request->color as $colors)
        {
            $product->product_color()->attach($colors);
        }
        foreach ($request->size as $sizes)
        {
            $product->product_size()->attach($sizes);
        }

        return redirect()->route('danhSachProduct')->with('thongbaothanhcong','bạn đã tao mới thành công');
    }

    public function getSua($id)
    {

        $product=Product::find($id);
        $color  =Color::all();
        $cate   =Category::all();
        $size   =Size::all();
        return view('backend.product.editProduct',['data'=>$product,'colors'=>$color,'cates'=>$cate,'sizes'=>$size]);
    }

    public function postSua(Request $request,$id)
    {
        $product=Product::find($id);
        $data = ($request->all());
        $relus =
            [
                'name'  => 'required|min:2|unique:product,name,'.$id,

            ];
        if(!is_null($request->price))
        {
            $relus['price']= 'min:2|numeric';
        }
        $messages =
            [
                'required' => ':attribute không được để trống',
                'min'      => ':attribute bạn phải nhập ít nhât là :min kí tự',
                'numeric'  => ':attribute định dạng số',
                'unique'   => ' Tên đã tồn tại',
                'mimes'    => 'file bạn đưa lên không phải định dạng file ảnh'
            ];
        $customAttribute =
            [
                'name'  => 'Tên',
                'price' => 'Giá Tiên',
                'color' => 'Màu sản Phẩm',
                'size'  => 'kich cỡ'
            ];

        $validate = Validator::make($data, $relus, $messages, $customAttribute);
        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }
        $product=Product::find($id);
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->category_id = $request->category;
         if($request->hasFile('images')){
             $file = $request->file('images');
             $name = $file->getClientOriginalName();
             $hinh = str_random(5) . '.' . $name;
             while (file_exists('css/image/' . $hinh))
             {
                 $hinh = str_random(5) . '.' . $name;
             }
             unlink("css/image/".$product->image);
             $file->move('css/image/', $hinh);
             $product->image = $hinh;
         }
        $product->save();

        if (!is_null($request->color))
        {
            $product->product_color()->detach();
            foreach ($request->color as $colors)
            {
                $product->product_color()->attach($colors);
            }
        }
        if (!is_null($request->size))
        {
            $product->product_size()->detach();
            foreach ($request->size as $sizes)
            {
                $product->product_size()->attach($sizes);
            }
        }
        //upload image detail
        if (Input::hasFile('imagepro'))
        {
            foreach (Input::file('imagepro') as $file)
            {
                $name=$file->getClientOriginalExtension();
                if ($name == 'png' || $name == 'jpg' || $name =='jpeg' || $name =='PNG' || $name =='JPG' || $name =='JPEG') {
                    $proimg = new Productimage();
                    if (isset($file))
                    {
                        $proimg->product_id = $product->id;
                        $file  ->move('css/image_detail/',$file->getClientOriginalName());
                        $proimg->name = $file->getClientOriginalName();
                        $proimg->save();
                    }

                } else

                    echo 'file đưa lên không đúng định dạng đuôi ảnh';
            }

        } return redirect()->route('danhSachProduct')->with('thongbaoAddProduct','bạn đã Sủa thành công!!');
    }



    //xoa product_imgame detail
    public function getxoaImg_detail($id)
    {
        $proimg=Productimage::find($id);
        $proimg->delete();
        unlink("css/image_detail/".$proimg->name);
        return back()->with('baocao','xóa thành công');
    }
    // xóa product
    public function getxoa(Request $request)
    {
        $id=$request->id;
        $product=Product::find($id);
        if (Order::where('product_id',$id)->first())
        {
            echo 'true';
            /*return back()->with('thongbao','bạn không thể xóa sản phẩm này vì sản phẩm này đã có người mua hàng, nếu xóa đi đồng nghĩa với việc bạn sẽ bị mất dữ liêu');*/
        }else
        {
            $product->delete();
            return redirect()->route('danhSachProduct')->with('thongbao','bạn đã xóa thành công!!');
        }


    }

}
