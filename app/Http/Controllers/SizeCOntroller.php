<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use Illuminate\Support\Facades\Validator;
class SizeCOntroller extends Controller
{
    //add category
    public function getThem(){
        return view('backend.size.addSize');
    }

    public function postThem(Request $request)
    {
        $data=$request->all();
        $relus=
            [
                'name'     => 'min:1|max:199|unique:size,name',
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
        $size=new Size();
        $size->name=$data['name'];
        $size->save();
        return redirect()->route('danhSachsize')->with('thongbaoadd','bạn đã tạo thành công');

    }

    //list cate
    public function getdanhSach()
    {
        $size=Size::paginate(10);
        return view('backend.size.listSize',['data'=>$size]);
    }

    //xoa cate
    public function getxoa(Request $request)
    {
        $id=$request->id;
        $size=Size::find($id);
        $size->delete();
        echo 'okie';
    }

    //sủa cate
    public function getSua($id)
    {
        $size=Size::find($id);
        return view('backend.size.editSize',['data'=>$size]);
    }
    public function postSua(Request $request,$id)
    {

        $data=($request->all());
        $relus=
            [

            ];
        if (!is_null($request->name)){
            $relus['name']='max:199|unique:category,name,'.$id;
        }

        $messages=
            [
                'max'     =>':attribute nhiều nhất là :max kí tự',
                'min'     =>':attribute ít nhất là :min kí tự',
                'unique'   =>':attribute Trường Đã Tồn Tại'
            ];
        $customAttribute=
            [
                'name'    =>'Tên'
            ];

        $validate=Validator::make($data,$relus,$messages,$customAttribute);

        if ($validate->fails())
        {
            return back()->withErrors($validate);
        }
        if (!is_null($data['name'])){
            $size      =Size::find($id);
            $size->name=$data['name'];
            $size->save();
        }
        return redirect()->route('danhSachsize')->with('thongbaothanhcong','bạn đã sửa thành công');
    }
}
