@extends('my.layout.main')
@section('title')
Hóa đơn
@endsection
@section('menu7')
active
@endsection
@section('content')
<main id="nha-tro" class="site-main">
    <section class="site-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 offset-lg-1 col-md-12">
            @include('my.layout.sidebar')
          </div>

          <div class="col-lg-7 col-md-12">
            <div class="card border-light mt-5">
              <div class="card-header">
                Hóa đơn
              </div>
              <div class="card-body">
                <div id="content-page">
                  <div class="gr-btn mb-4">
                    {{-- <a href="{{ route('my.bill.getCreate') }}" class="btn btn-outline-primary btn-sm mr-2"><i class="fas fa-plus-circle mr-2"></i>Thêm mới</a> --}}
                    {{-- <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash mr-2"></i>Xóa nhiều</button> --}}
                  </div>
                  <div class="row mb-3">
                    <div class="col-6">
                    <div><b>Tên hóa đơn: </b> {{ $data->name }}</div>
                    </div>
                    <div class="col-6">
                    <div><b>Mã hợp đồng: </b> #MHĐ{{ $data->contract_id }}</div>
                    </div>
                  </div>
                  <div class="table-responsive-lg">
                      @if(sizeof($data->billservice) > 0)
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Tên dịch vụ</th>
                          <th scope="col">Đơn vị</th>
                          <th scope="col">Đơn giá</th>
                          <th scope="col">Số lượng</th>
                          <th scope="col">Thành tiền</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($data->billservice as $k => $v)
                          <tr>
                            <th scope="row">
                              {{ $v->service->title }}
                            </th>
                            <td>{{ $v->unit }}</td>
                            <td>{{ number_format($v->price) }}đ</td>
                            <td>{{ number_format($v->qty) }}</td>
                            <td>{{ number_format($v->total) }}đ</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div><b>Tiền phòng: </b>{{ number_format($data->room_price) }}đ</div>
                      <div><b>Tiền dịch vụ: </b>{{ number_format($data->service_price) }}đ</div>
                      <div><b>Chi phí khác: </b>{{ number_format($data->other_price) }}đ</div>
                    </div>
                    <div class="col-6">
                      <div><b>Dư nợ cũ: </b>{{ number_format($data->debit_price) }}đ</div>
                      <div><b>Khấu trừ: </b>{{ number_format($data->discount_price) }}đ</div>
                      <div><b>Tổng tiền: </b>{{ number_format($data->total_price) }}đ</div>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                <a name="" id="" class="btn btn-secondary mr-2" href="{{ route('my.bill.getList') }}" role="button"><i class="fas fa-long-arrow-alt-left mr-2"></i>Trở về</a>
                <a name="" id="" class="btn btn-danger" href="{{ route('my.bill.pdf', $data->id) }}" role="button"><i class="fas fa-file-pdf mr-2"></i>Xuất hóa đơn</a>
                </div>
                <div id="mdl1"></div>
                <div id="mdl3"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main id="phong-tro">

@endsection
@section('custom_js')
<script>
    function setTitle (title, element) {
      element.text(title)
    }
    $('#nha-tro .table th span').click(function() {
      $('#md-app-name').text($(this).data('name'))
      var buttNum = this.id.split('_')[1]
      var content = $('#mdl'+buttNum).html()
      $('#modalHouse .modal-body').html(content)
    })
  </script>
@endsection
