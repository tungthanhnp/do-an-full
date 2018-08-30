<table style="text-align: center" border="1px solide " width="600px">
   <tr>
       <th>STT</th>
       <th>name</th>
       <th>Giá</th>
       <th>Số Lượng</th>
       <th>Ảnh</th>
       <th>màu</th>
       <th>size</th>
       <th>thành tiền</th>
   </tr>
    @php $i=0 @endphp
    @foreach($data as $key => $value)
        @php $i++ @endphp

    <tr>
        <td>{!! $i !!}</td>
        <td>{!! $value['name'] !!}</td>
        <td>{!! $value['price'] !!}</td>
        <td>{!! $value['qty'] !!}</td>
        @php $images= $value['options']['img'] @endphp
        @php $pathToFile= 'css/image/'.$images @endphp
        {{--<td><img style="width: 50px;" src="{!! asset('css/image/'.$images) !!}" alt=""></td>--}}
        {{--<td><img src="data:image/png;base64,{{base64_encode(file_get_contents(resource_path($pathToFile)))}}" alt=""></td>--}}

        <td> <img style="width: 70px;" src="{!! $message->embed($pathToFile) !!} "></td>
        <td>{!! $value['options']['color'] !!}</td>
        <td>{!! $value['options']['size'] !!}</td>
        <td>{!! $value['price'] * $value['qty']  !!}</td></td>
    </tr>
    @endforeach
</table>
<h1>Tổng Tiền:{!! $total !!}</h1>