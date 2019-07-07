<strong>Thông tin đơn hàng</strong>
<div>
    MGH: {{ $order->id }}
</div>
<div>
    Tổng tiền (đã chiết khấu): {{ number_format($order->total,0,',','.') }}
</div>
<br>
<strong>Thông tin khách hàng</strong>
<div>Tên: {{ $order->orderInfo->name }}</div>
<div>Email: {{ $order->orderInfo->email }}</div>
<div>SĐT: {{ $order->orderInfo->phone }}</div>
<br>
<strong>Chi tiết đơn hàng</strong>
<table border="1">
    <tr>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Kích thước (dxrxc)</th>
        <th>Đơn giá (VNĐ)</th>
        <th>Tổng (VNĐ)</th>
    </tr>
    @foreach($order->orderDetail as $v)
    <tr>
    <td>{{ $v->title }}</td>
    <td>{{ $v->qty }}</td>
    <td>{{ $v->width }}x{{ $v->depth }}x{{ $v->height }}</td>
    <td>{{ number_format($v->price,0,',','.') }}</td>
    <td>{{ number_format($v->total,0,',','.') }}</td>
    </tr>
    @endforeach
</table>