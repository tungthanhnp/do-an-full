<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
//them user admin
    public function getThem()
    {
        $user=Auth::user();
        return view('backend.user.addUser',['user'=>$user]);
    }

    public function postThem(Request $request)
    {
        $data = $request->all();

        $relus =
            [
                'email'       => 'required|min:9|unique:users,email|email',
                'password'    => 'required|min:6|max:200',
                'passwordold' => 'required|same:password',
                'phone'       => 'numeric',
                'avatar'      => 'required|mimes:jpg,jpeg,png,|max:5000kb',

            ];
        $messages =
            [
                'required' => ':attribute không được để trống',
                'min'      => ':attribute bạn phải nhập ít nhât là :min kí tự',
                'max'      => ':attribute bạn chỉ được nhập nhiều nhất là :max kí tự',
                'numeric'  => ' bạn phải nhập đúng định dạng số điện thoai',
                'same'     => 'mật khẩu nhập lại không đúng',
                'email'    => 'bạn phải nhập đúng định dạng email',
                'unique'   => 'email đã tồn tại',
                'mimes'    =>'ảnh phải có đuôi img , png hoăc jpg',
                'size'     =>'độ lơn tối đa của ảnh là 5mb'


            ];
        $customAttribute =
            [

                'phone' => 'số điện thoại'
            ];
        $validate = Validator::make($data, $relus, $messages, $customAttribute);
        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }
        $user = new User();
        $user->remember_token = $request->_token;
        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->password       = bcrypt($request->password);
        $user->address        = $request->address;
        $user->phone          = $request->phone;
        $user->lever          = $request->quyen;
        if ($request->hasFile('avatar'))
        {
            $file=$request->avatar;
            $namefile=$file->getClientOriginalName();
            $name=time().'-'.$namefile;
            $file->move('css/image-user/',$name);
            $user->avatar=$name;
        }

        $user->save();
        return redirect()->route('danhSachUser')->with('thongbaothanhcong', 'bạn đã tạo mới thành công');
    }

//danhsach User
    public function getdanhSach()
    {
        $user = User::paginate(10);
        $users=Auth::user();
        return view('backend.user.listUser', ['data' => $user,'users'=>$users]);
    }


// xoa user
    public function getxoa($id)
    {
        $users = User::find($id);
        $user  =User::all();
        if(Order::where('user_id',$id)->first()  )
        {
            $order=Order::where('user_id',$id)->first();
            if ($users->id == $order->user_id)
            {
                return back()->with('thongbao','bạn không thể xóa user này vì user này đã từng mua hàng , nếu bạn xóa thì đồng nghĩa sẽ mất dữ liệu');
            }
        }else
        {
            if (Auth::user()->lever ==2 && $users->lever != 2)
            {
                $users->delete();
                return redirect()->route('danhSachUser')->with('thongbao', 'bạn đã xóa thành công');

            }elseif(Auth::user()->lever ==2 && $users->lever ==2)
            {
                return redirect()->route('danhSachUser')->with('thongbao', 'bạn  không thể xóa được chính mình');

            }elseif($users->lever ==1 && Auth::user()->lever ==1 && $users->id != Auth::user()->id)
            {
                return back()->with('thongbao', 'bạn không thể xóa user này vì đây ũng là user admin');

            }elseif ($users->lever ==1 && Auth::user()->lever==1 && $users->id == Auth::user()->id)
            {
                return back()->with('thongbao', 'bạn là user admin và bạn không thể xóa chính mình');

            }elseif ($users->lever ==0)
            {
                $users->delete();
                return redirect()->route('danhSachUser')->with('thongbao', 'bạn đã xóa thành công');
            }
            foreach ($user as $us)
            {
                if ($us->lever ==2 && Auth::user()->lever ==1)
                {
                    return redirect()->route('danhSachUser')->with('thongbao', 'bạn chỉ là admin bạn không thể xóa supper admin');
                }
            }

        }

    }

//sửa user
    public function getSua($id)
    {
        $user=Auth::user();
        $data = User::find($id);
        return view('backend.user.editUser', ['data' => $data,'users'=>$user]);
    }

    public function postSua(Request $request, $id)
    {
        $data = $request->all();
        $relus =
            [
                'email'       => 'min:9|email|unique:users,email,' . $id,
                'passwordold' => 'same:password',
                'phone'       => 'numeric',

            ];
        if (!is_null($request->password))
        {
            $relus['password'] = 'required|min:6|max:40';

        }if (!is_null($request->avatar))
        {
            $relus['avatar'] =  'mimes:jpg,JPG,PNG,JPEG,jpeg,png,|max:5000kb';

        }

        $messages =
            [
                'required' => ':attribute không được để trống',
                'min'      => ':attribute bạn phải nhập ít nhât là :min kí tự',
                'max'      => ':attribute bạn chỉ được nhập nhiều nhất là :max kí tự',
                'numeric'  => ' bạn phải nhập đúng định dạng số điện thoai',
                'same'     => 'mật khẩu nhập lại không đúng',
                'email'    => 'bạn phải nhập đúng định dạng email',
                'unique'   => 'email đã tồn tại',
                'mimes'    => 'ảnh phải có đuôi à jpg , png , jpeg',
            ];
        $customAttribute =
            [
                'phone'    => 'số điện thoại'
            ];
        $validate = Validator::make($data, $relus, $messages, $customAttribute);
        if ($validate->fails()) {
            return back()->withErrors($validate);

        }
        $user        = User::find($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        if (!is_null($request->password))
        {
            $user->password = bcrypt($request->password);
        }
        $user->address = $request->address;
        $user->phone   = $request->phone;
        $user->lever   = $request->quyen;
        if (!is_null($request->avatar)){
            unlink('css/image-user/'.$user->avatar);
            $file=$request->avatar;
            $filename=$file->getClientOriginalName();
            $name=time().'-'.$filename;
            $file->move('css/image-user/',$name);
            $user->avatar=$name;
        }
        $user->save();
        return redirect()->route('danhSachUser')->with('thongbaothanhcong', 'bạn đã sửa thành công');
    }
    public function ajaxSua(Request $request)
    {
        $id=($request->id);
        $user=User::find($id);
        $users=User::where('lever',2)->get()->toArray();
        if (Auth::user()->lever==2)
        {
            echo 'supper';
        }else if ($user->lever==2 && Auth::user()->lever==1){

            echo 'bạn không có quyền sửa supper admin';
        }
        else if ($user->lever ==1 && Auth::user()->lever==1 && $user->id == Auth::user()->id)
        {
            echo 'okie';
        }
        else if ($user->lever ==1 && Auth::user()->lever==1 && $user->id != Auth::user()->id)
        {
            echo 'Bạn không có quyền sửa users này vì người này cũng là admin';
        } else if ($user->lever ==0) {
            echo 'users';
        }
    }
}
