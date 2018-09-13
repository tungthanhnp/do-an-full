<?php

namespace App\Http\Controllers;

use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Responseon;
use Illuminate\Cookie;
use App\User;
use App\Category;
Use App\Color;
use App\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Order;


class FonendController extends Controller
{
    function __construct()
    {
        $cate = Category::all();
        View::share('cate', $cate);
    }

    public function trangchu()
    {
        $pro = Product::paginate(9);
        return view('fonend.pages.content', ['product' => $pro]);
    }

    public function login()
    {
        return view('fonend.pages.login');
    }

    public function blog()
    {
        return view('fonend.pages.blog');
    }

    public function contact()
    {
        return view('fonend.pages.contact');
    }

    public function postlogin(Request $request)
    {
        $data = $request->all();

        $rules =
            [
                'email'    => 'required|min:9|max:40|email',
                'password' => 'required|min:6',
            ];
        $messages =
            [
                'required' => ':attribute không được để trống',
                'min'      => ':attribute ít nhât là :min kí tự',
                'max'      => ':attribute nhiều nhất là :max kí tự',
                'email'    => 'bạn phải nhập đúng định dạng email',

            ];
        $customAttribute =
            [
                'email'    => 'email',
                'password' => 'mật khẩu'
            ];

        $validation = Validator::make($data, $rules, $messages, $customAttribute);
        if ($validation->fails())
        {
            return back()->withErrors($validation)->withInput();
           /* return Response()->json([
                'errors'=>'true',
                'mes'   =>$validation->errors()
        ]);*/
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password] ,true))
        {
            if (Auth::user()->lever == 1 || Auth::user()->lever == 2) {
                return redirect()->route('danhSachorder');


            } else {
                return redirect()->route('trangchu');
            }
        } else
            return back()->with('thongbao', 'bạn đã nhập sai tên tài khoản hoặc mật khẩu');
    }


    //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('trangchu');
    }

    public function logout_user()
    {
        Auth::logout();
        return redirect()->route('trangchu');
    }

    // addusser
    public function dangki()
    {
        return view('fonend.pages.dangki');
    }

    public function postdangki(Request $request)
    {
        $data = $request->all();


        $relus =
            [
                'email'        => 'required|min:9|unique:users,email|email',
                'password'     => 'required|min:6|max:200',
                'passwordold'  => 'required|same:password',
                'phone'        => 'numeric',
                'avatar'       => 'required|mimes:jpg,jpeg,png,|max:5000kb',

            ];
        $messages =
            [
                'required'     => ':attribute không được để trống',
                'min'          => ':attribute bạn phải nhập ít nhât là :min kí tự',
                'max'          => ':attribute bạn chỉ được nhập nhiều nhất là :max kí tự',
                'numeric'      => ' bạn phải nhập đúng định dạng số điện thoai',
                'same'         => 'mật khẩu nhập lại không đúng',
                'email'        => 'bạn phải nhập đúng định dạng email',
                'unique'       => 'email đã tồn tại',
                'mimes'        => 'ảnh phải có đuôi img , png hoăc jpg',
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
        $user->remember_token  = $request->_token;
        $user->name            = $request->name;
        $user->email           = $request->email;
        $user->password        = bcrypt($request->password);
        $user->address         = $request->address;
        $user->phone           = $request->phone;
        $user->lever           = 0;
        if ($request->hasFile('avatar'))
        {
            $file=$request->avatar;
            $namefile=$file->getClientOriginalName();
            $name=time().'-'.$namefile;
            $file->move('css/image-user/',$name);
            $user->avatar=$name;
        }
        $user->save();
        return back()->with('thongbaothanhcong', 'bạn đã tao mới thành công');
        /*return redirect()->route('danhSachUser')->with('thongbaothanhcong','bạn đã tao mới thành công');*/
    }

    public function detail($id)
    {
        $pro = Product::find($id);
        return view('fonend.pages.detail', ['product' => $pro]);
    }


    //cate_pro
    public function category_product($id)
    {
        $category   = Category::find($id);
        $pro        = Product::where('category_id', $id)->paginate(9);
        return view('fonend.pages.detailCate', ['category' => $category, 'product' => $pro]);
    }


    public function addcart(Request $request, $id)
    {
         $data=$request->all();
        $relus          =['quantity' => 'numeric|required'];
        $messages       =['numeric'  =>'bạn nhập sai định dạng số lượng','required' =>'bạn phải nhập số lượng'];
        $customAttribute=[];
        $validate = Validator::make($data, $relus, $messages, $customAttribute);
        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }

        $pro   = Product::find($id);
        $color = Color::find($request->color)->name;
        $size  = Size::find($request->size)->name;
        Cart::add($pro->id, $pro->name, $request->quantity, $pro->price, [
            'img'   => $pro->image,
            'color' => $color,
            'size'  => $size,
        ]);
        $cart = Cart::content();
        return redirect()->route('checkout');

    }

    public function checkout()
    {
        $cart  = Cart::content()->toArray();
        $num=0;
        foreach ($cart as $value)
        {
            $num+= $value['subtotal'];
        }
        $color = Color::all();
        $size  = Size::all();
        if (Auth::check()) {
            $user = Auth::user();
            return view('fonend.pages.checkout',
                [   'cart'     => $cart,
                    'username' => $user,
                    'total'    => $num,
                    'color'    => $color,
                    'size'     => $size,
                ]);
        } else {
            return view('fonend.pages.checkout',
                [   'cart'  => $cart,
                    'total' => $num,
                    'color' => $color,
                    'size'  => $size,
                ]);
        }

    }

    public function delCart($id)
    {
        Cart::remove($id);
        return back()->with('thongbao', 'bạn đã xóa thành công');
    }

  /*  public function updateCart(Request $request, $id)
    {
        $color = Color::find($request->color)->name;

        if  (!is_null($request->qty))
        {
            Cart::update($id, $request->qty);
        }
        return back();


    }*/


    public function sendmai(Request $request)
    {
        $data = $request->all();
        $relus =
            [
                'email'    => 'min:9|email|required',
                'name'     => 'min:2|required',
                'phone'    => 'numeric|required',
                'address'  =>  'min:9|required'

            ];
        $messages =
            [
                'required' => ':attribute không được để trống',
                'min'      => ':attribute bạn phải nhập ít nhât là :min kí tự',
                'numeric'  => ' bạn phải nhập đúng định dạng số điện thoai',
                'email'    => 'bạn phải nhập đúng định dạng email',
            ];
        $customAttribute =
            [
                'phone'    => 'số điện thoại'
            ];
        $validate = Validator::make($data, $relus, $messages, $customAttribute);
        if ($validate->fails()) {
            return back()->withErrors($validate);

        }
        $nameuser     = $request->email;
        if (Auth::check())
        {
            $nameuser = Auth::user()->email;
        }

        $cart         = Cart::content()->toArray();
        $total=0;
        foreach ($cart as $value)
        {
            $total+= $value['subtotal'];
        }
        $data         = ['data' => $cart, 'total' => $total, 'name' => $nameuser];

        Mail::send('fonend.pages.mail', $data, function ($message) use ($data) {

            $message  ->from('mr.tom005101@gmail.com', 'tungthanh');
            $message  ->to($data['name']);
            $message  ->subject('thư xác nhận đơn hàng');

        });
        foreach ($cart as $cartr) {
            $order            = new Order();
            $order->address   = $request->address;
            $order->email     = $request->email;
            $order->phone     = $request->phone;

            $order->ordername = $request->name;

            $order->color     = $cartr['options']['color'];
            $order->price     = $cartr['price'];
            $order->qty       = $cartr['qty'];
            $order->size      = $cartr['options']['size'];
            $order->total     = $cartr['price'] * $cartr['qty'];
            $order->status    = 1;
            if (Auth::check()) {
                $order->user_id = Auth::user()->id;
            }else{
                $order->user_id = 0;
            }
            $order->image      = $cartr['options']['img'];
            $order->product_id = $cartr['id'];
            $order->save();
        }
        Cart::destroy();
        return redirect()->route('trangchu');
    }

    public function addmail()
    {
        return view('fonend.pages.mail');
    }

    public function timkiem(Request $request)
    {
        $sear = $request->name;
        $data = Product::Where('name','like','%'.$sear.'%')->orWhere('price','like','%'.$sear.'%')->orWhere('image','like','%'.$sear.'%')->get();
        return view('fonend.pages.search',['database'=>$data,'names'=>$sear]);
    }
    public function lichsu($id)
    {
        $order=Order::where('user_id',$id)->get();
        return view('fonend.pages.lichsua',['order'=>$order]);
    }
    public function xoadonhang(Request $request)
    {
        $id=$request->id;
        $order=Order::find($id);
        if ($order->status !=1)
        {
            echo "flase";
        }else
        {
            $order->delete();
            echo "true";
        }

    }
}
