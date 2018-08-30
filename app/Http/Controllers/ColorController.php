<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    //danhsach
    public function getdanhSach()
    {
        $color=Color::paginate(10);
        return view('backend.color.listColor',['data'=>$color]);
    }


    //thêm color
    public function getThem()
    {
        return view('backend.color.addColor');
    }

    public function postThem(Request $request)
    {
        $data=$request->all();
        $relus=
            [
                'name'     => 'min:2|max:199|unique:category,name',
                'color'    => 'required|min:3|max:30'
            ];
        $messages=
            [
                'max'     =>':attribute nhiều nhất là :max kí tự',
                'unique'  =>':attribute Trường Đã Tồn Tại',
                'min'     =>':attribute Ít Nhát Là :min Kí Tự'
            ];
        $customAttribute=
            [
                'name'    =>'Tên',
                'color'   =>'màu'
            ];

        $validate=Validator::make($data,$relus,$messages,$customAttribute);

        if ($validate->fails())

        {
            return back()->withErrors($validate)->withInput();
        }
        $color=new Color();
        $color->name=$data['name'];
        $color->code=$data['color'];
        $color->save();
        return redirect()->route('danhSachColor')->with('thongbaoadd','bạn đã tạo thành công');

    }

    //sửa
    public function getSua($id)
    {
        $color=Color::find($id);
        return view('backend.color.editColor',['data'=>$color]);
    }

    public function postSua(Request $request,$id)
    {
        $data =($request->all());
        $relus=
            [
                'name'   => 'max:199|unique:category,name,'.$id,

            ];
        if (!is_null($request->code))
        {
            $relus['code']='required|min:3|max:30';
        }
        $messages=
            [
                'max'     =>':attribute nhiều nhất là :max kí tự',
                'min'     =>':attribute ít nhất là :min kí tự',
                'unique'   =>':attribute Trường Đã Tồn Tại'
            ];
        $customAttribute=
            [
                'name'    =>'Tên',
                'code'    =>'Màu'
            ];

        $validate=Validator::make($data,$relus,$messages,$customAttribute);

        if ($validate->fails())
        {
            return back()->withErrors($validate);
        }
        $color      =Color::find($id);
        $color->name=$data['name'];

        if (!is_null($data['code']))
        {
            $color->code=$data['code'];
        }
        $color->save();
        return redirect()->route('danhSachColor')->with('thongbaothanhcong','bạn đã sửa thành công');
    }

    //xoa color
    public function getxoa($id)
    {
        $color=Color::find($id);
        $color->delete();
        return redirect()->route('danhSachColor')->with('thongbao','bạn đã xóa thành công');
    }

}
