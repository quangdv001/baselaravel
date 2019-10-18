<strong>Thông tin đơn hàng</strong>
<div>
    MGH: {{ $order->id }}
</div>
<br>
<strong>Thông tin khách hàng</strong>
<div>Tên: {{ $order->orderInfo->name }}</div>
<div>Email: {{ $order->orderInfo->email }}</div>
<div>SĐT: {{ $order->orderInfo->phone }}</div>
<div>Địa chỉ: {{ $order->orderInfo->address }}</div>
<br>
<strong>Chi tiết đơn hàng</strong>
<div>Từ: {{ $order->orderDetail->start_name }}</div>
<div>Đến: {{ $order->orderDetail->end_name }}</div>
@if ($order->orderDetail->is_round_trip == 1)
    <div>Loại chuyến: Khứ hồi</div>
    <div>Ngày: {{ date('d/m/Y', $order->orderDetail->start_time) }} - {{ date('d/m/Y', $order->orderDetail->end_time) }}</div>
@else
    <div>Loại chuyến: Một chiều</div>
    <div>Ngày: {{ date('d/m/Y', $order->orderDetail->start_time) }}</div>
@endif
<div>Mã tàu: {{ $order->orderDetail->train_no }}</div>
@if ($order->payment_method == 0)
    <div>Phương thức thanh toán: Credit Card</div>
@elseif ($order->payment_method == 1)
    <div>Phương thức thanh toán: Transfer</div>
@else
    <div>Phương thức thanh toán: Direct</div>
@endif
<div>Số vé: {{ $order->orderDetail->qty }}</div>
<div>Ghi chú: {{ $order->orderInfo->note }}</div>