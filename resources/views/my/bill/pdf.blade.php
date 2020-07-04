<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    {{-- <meta charset="utf-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; }
        .text-bold{
            font-weight: 500;
            text-transform: uppercase
        }
        table th{
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
        }
      </style>
  </head>
  <body>
    <div class="container-fluid border pt-3" style="padding-bottom: 100px">
        <div class="text-center text-bold">HÓA ĐƠN TIỀN TRỌ</div>
        <div class="text-center">{{ $bill->name }}</div>
        <div>Tên phòng: {{ $bill->contract->room->name }}</div>
        <table class="table border mt-2">
            <thead>
                <tr>
                    <th>Nội dung</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">Tiền phòng</td>
                    <td>1</td>
                    <td>{{ number_format($bill->room_price) }}</td>
                    <td>{{ number_format($bill->room_price) }}đ</td>
                </tr>
                @if(sizeof($bill->billservice) > 0)
                @foreach($bill->billservice as $v) 
                <tr>
                <td scope="row">{{ $v->service->title }}</td>
                    <td>{{ $v->qty }} {{$v->unit}}</td>
                    <td>{{ number_format($v->price) }}</td>
                    <td>{{ number_format($v->total) }}đ</td>
                </tr>
                @endforeach
                @endif
                @if($bill->debit_price > 0)
                <tr>
                    <td scope="row">Tiền nợ</td>
                    <td></td>
                    <td>{{ number_format($bill->debit_price) }}</td>
                    <td>{{ number_format($bill->debit_price) }}đ</td>
                </tr>
                @endif
                @if($bill->other_price > 0)
                <tr>
                    <td scope="row">Tiền khác</td>
                    <td></td>
                    <td>{{ number_format($bill->other_price) }}</td>
                    <td>{{ number_format($bill->other_price) }}đ</td>
                </tr>
                @endif
                @if($bill->discount_price > 0)
                <tr>
                    <td scope="row">Tiền giảm giá</td>
                    <td></td>
                    <td>{{ number_format($bill->discount_price) }}</td>
                    <td>{{ number_format($bill->discount_price) }}đ</td>
                </tr>
                @endif
                <tr>
                <td colspan="4">Tổng tiền: {{ number_format($bill->total_price) }}đ</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%">
            <tr>
                <td style="width: 50%" class="text-center"><div class="text-bold">BÊN CHO THUÊ</div>
                    <div>(ký và ghi rõ họ tên)</div></td>
                <td style="width: 50%" class="text-center"><div class="text-bold">BÊN THUÊ</div>
                    <div>(ký và ghi rõ họ tên)</div></td>
            </tr>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>