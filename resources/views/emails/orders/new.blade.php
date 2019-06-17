<div>
    Id: {{ $order->id }}
</div>
<div>
    Price: {{ $order->total }}
</div>
<p>{{ $order->orderInfo->name }}</p>
<p>{{ $order->orderInfo->email }}</p>
<p>{{ $order->orderInfo->phone }}</p>

<table>
    <tr>
        <th>title</th>
        <th>qty</th>
        <th>size</th>
        <th>price</th>
        <th>total</th>
    </tr>
    @foreach($order->orderDetail as $v)
    <tr>
    <td>{{ $v->title }}</td>
    <td>{{ $v->qty }}</td>
    <td>{{ $v->width }}x{{ $v->depth }}x{{ $v->height }}</td>
    <td>{{ $v->price }}</td>
    <td>{{ $v->total }}</td>
    </tr>
    @endforeach
</table>