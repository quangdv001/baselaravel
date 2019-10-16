<strong>Thông tin đơn hàng</strong>
<div>
    MGH: {{ $order->id }}
</div>
<br>
<strong>Thông tin khách hàng</strong>
<div>Tên: {{ $order->orderInfo->name }}</div>
<div>Email: {{ $order->orderInfo->email }}</div>
<div>SĐT: {{ $order->orderInfo->phone }}</div>
<br>
<strong>Chi tiết đơn hàng</strong>
<div>Từ: {{ $order->orderDetail->start_name }}</div>
<div>Đến: {{ $order->orderDetail->end_name }}</div>
<div>Ngày: {{ date('d/m/Y', $order->orderDetail->start_time) }} - {{ date('d/m/Y', $order->orderDetail->end_time) }}</div>
<div>Số vé: {{ $order->orderDetail->qty }}</div>