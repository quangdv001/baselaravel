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
      </style>
  </head>
  <body>
    <div class="container">
        <div class="text-center">
            <div class="text-bold">Cộng hòa xã hội chủ nghĩa Việt Nam</div>
            <div>Độc lập - Tự do - Hạnh phúc</div>
        </div>
        <div class="text-right">.......... , ngày .... tháng .... năm ....</div>
        <div class="text-center text-bold">Hợp đồng thuê trọ</div>
        <div>Chúng tôi gồm:</div>
        <div>1.Đại diện bên cho thuê phòng trọ (Bên A):</div>
        <div>Ông/bà: {{ $user->name }}</div>
        <div>Nơi đăng ký HK: {{ $user->address }}</div>
        <div>CMND số: {{ $user->id_number }} &nbsp; cấp ngày {{ date('d/m/Y', $user->id_time) }} &nbsp; tại:{{ $user->id_place }}</div>
        <div>Số điện thoại: {{ $user->phone }}</div>
        <div>2. Bên thuê phòng trọ (Bên B):</div>
        <div>Ông/bà: {{ $contract->customer->name }}</div>
        <div>Nơi đăng ký HK: {{ $contract->customer->address }}</div>
        <div>CMND số: {{ $contract->customer->id_number }} &nbsp; cấp ngày {{ date('d/m/Y', $contract->customer->id_time) }} &nbsp; tại:{{ $contract->customer->id_place }}</div>
        <div>Số điện thoại: {{ $contract->customer->phone }}</div>
        <div class="text-bold">Sau khi bàn bạc trên tinh thần dân chủ, hai bên cùng có lợi, cùng thống nhất như sau:</div>
        <div>Bên A đồng ý cho bên B thuê 01 phòng ở tại địa chỉ:</div>
        <div>{{ $contract->room->motel->address }}</div>
        <div>Giá thuê: {{ number_format($contract->room->price) }}đ/tháng, thời hạn đóng tiền nhà từ ngày {{ date('d/m/Y', $contract->start) }} đến ngày {{ date('d/m/Y', $contract->end) }} hằng tháng.</div>
        <div>Hình thức thanh toán: ………………………………………………………….....</div>
        @if(sizeof($contract->service) > 0)
            @foreach($contract->service as $v) 
            <div>{{ $v->service->title }}: {{ number_format($v->service->price) }}đ/{{ $v->service->unit }}</div>
            @endforeach
        @endif
        {{-- <div>Tiền điện …………..….đ/kwh tính theo chỉ số công tơ, thanh toán vào cuối các tháng.</div>
        <div>Tiền nước: ………….đ/người thanh toán vào đầu các tháng.</div> --}}
        <div>Tiền đặt cọc: {{ number_format($contract->deposits) }}.</div>
        <div>Hợp đồng có giá trị kể từ ngày {{ date('d/m/Y', $contract->start) }} đến {{ date('d/m/Y', $contract->end) }}.</div>
        <div class="text-bold">1. TRÁCH NHIỆM CỦA CÁC BÊN</div>
        <div class="text-bold">1.1. Trách nhiệm của bên A:</div>
        <div>- Tạo mọi điều kiện thuận lợi để bên B thực hiện theo hợp đồng.</div>
        <div>- Cung cấp nguồn điện, nước, wifi cho bên B sử dụng.</div>
        <div>- Bên A phải hoàn trả tiền đặt cọc cho bên B khi hợp đồng này hết thời hạn.</div>
        <div class="text-bold">1.2. Trách nhiệm của bên B:</div>
        <div>- Thanh toán đầy đủ các khoản tiền theo đúng thỏa thuận.</div>
        <div>- Bảo quản các trang thiết bị và cơ sở vật chất của bên A trang bị cho ban đầu (làm hỏng phải sửa, mất phải đền).</div>
        <div>- Không được tự ý sửa chữa, cải tạo cơ sở vật chất khi chưa được sự đồng ý của bên A.</div>
        <div>- Giữ gìn vệ sinh trong và ngoài khuôn viên của phòng trọ.</div>
        <div>- Bên B phải chấp hành mọi quy định của pháp luật Nhà nước và quy định của địa phương.</div>
        <div>- Nếu bên B cho khách ở qua đêm thì phải báo và được sự đồng ý của chủ nhà đồng thời phải chịu trách nhiệm về các hành vi vi phạm pháp luật của khách trong thời gian ở lại.</div>
        <div class="text-bold">2. THỎA THUẬN CHUNG</div>
        <div>- Hai bên phải tạo điều kiện cho nhau thực hiện hợp đồng.</div>
        <div>- Trong thời gian hợp đồng còn hiệu lực nếu bên nào vi phạm các điều khoản đã thỏa thuận thì bên còn lại có quyền đơn phương chấm dứt hợp đồng; nếu sự vi phạm hợp đồng đó gây tổn thất cho bên bị vi phạm hợp đồng thì bên vi phạm hợp đồng phải bồi thường thiệt hại.</div>
        <div>- Một trong hai bên muốn chấm dứt hợp đồng trước thời hạn thì phải báo trước cho bên kia ít nhất 30 ngày và hai bên phải có sự thống nhất.</div>
        <div>- Bên nào vi phạm hợp đồng này phải chịu trách nhiệm đối với bên còn lại và chịu trách nhiệm trước pháp luật.</div>
        <div>- Hợp đồng được lập thành 02 bản có giá trị pháp lý như nhau, mỗi bên giữ một bản.</div>
        <div>- Hợp đồng này có hiệu lực kể từ ngày các bên ký. </div>
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