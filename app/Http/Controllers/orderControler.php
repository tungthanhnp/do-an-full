<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class orderControler extends Controller
{
    public function getdanhSach()
    {
        $data = Order::orderBy('created_at','DESC')->paginate(5);
//       $data=Order::paginate(5);

       return view('backend.order.listorder',['data'=>$data]);
    }

    public function getxoa(Request $request)
    {
        $id=$request->id;
        $data=Order::find($id);
        if ($data->status==2 || $data->status==3 ){
             echo 'true';
        }else{
            $data->delete();
            echo 'false';
        }
    }
    public function xacnhandon($id)
    {
        $order=Order::find($id);
        $order->status=2;
        $order->save();
        return redirect() ->route('danhSachorder')->with('baocao','xác nhận đơnhàng thành công');
    }
    public function xacnhandondagiao($id)
    {
        $order=Order::find($id);
        $order->status=3;
        $order->save();
        return redirect() ->route('danhSachorder')->with('baocaodongdon','Đã Đóng Đơn Hàng NÀy');
    }
}
