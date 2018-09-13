<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;
use App\Product;

class categoryControler extends Controller
{
    //add category
    public function getThem()
    {
        return view('backend.category.addCategory');
    }
    public function postThem(Request $request)
    {
      $data=$request->all();
        $relus=
            [
                'name'     => 'min:2|max:199|unique:category,name',
            ];
        $messages=
            [
                'max'     =>':attribute nhiều nhất là :max kí tự',
                'unique'  =>':attribute Trường Đã Tồn Tại',
                'min'     =>':attribute Ít Nhát Là :min Kí Tự'
            ];
        $customAttribute=
            [
                'name'    =>'Tên'
            ];

        $validate=Validator::make($data,$relus,$messages,$customAttribute);

        if ($validate->fails())

        {
            return back()->withErrors($validate)->withInput();
        }
        $cate=new Category();
        $cate->name=$data['name'];
        $cate->save();
        return redirect()->route('danhSachcate')->with('thongbaoadd','bạn đã tạo thành công');

    }

    //list cate
    public function getdanhSach()
    {
        $cate=Category::paginate(10);
        return view('backend.category.listCategory',['data'=>$cate]);
    }

    //xoa cate
    public function getxoa(Request $request)
    {
        $id = $request->id;
        $cate = Category::find($id);
        $pro = Product::where('category_id', $id)->first();
        if ($pro) {
            echo 'true';
        } else
            $cate->delete();
    }

    //sủa cate
    public function getSua($id)
    {
        $cate=Category::find($id);
        return view('backend.category.editCate',['data'=>$cate]);
    }
    public function postSua(Request $request,$id)
{

    $data=($request->all());
    $relus=
        [
            'name'     => 'max:199|unique:category,name,'.$id,
        ];
    $messages=
        [
            'name'     =>':attribute nhiều nhất là :max kí tự',
            'unique'   =>':attribute Trường Đã Tồn Tại'
        ];
    $customAttribute=
        [
            'name'     =>'Tên'
        ];

    $validate=Validator::make($data,$relus,$messages,$customAttribute);

    if ($validate->fails())

    {
        return back()->withErrors($validate);
    }
    if (!is_null($data['name']))
    {
        $cate=Category::find($id);
        $cate->name=$data['name'];
        $cate->save();
    }
    return redirect()->route('danhSachcate')->with('thongbaothanhcong','bạn đã sửa thành công');
}
}
