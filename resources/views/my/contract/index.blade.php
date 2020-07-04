@extends('my.layout.main')
@section('title')
Danh sách hợp đồng
@endsection
@section('menu4')
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
                Hợp đồng
              </div>
              <div class="card-body">
                <div id="content-page">
                  <div class="gr-btn mb-4">
                    <a href="{{ route('my.contract.getCreate') }}" class="btn btn-outline-primary btn-sm mr-2"><i class="fas fa-plus-circle mr-2"></i>Thêm mới</a>
                    {{-- <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash mr-2"></i>Xóa nhiều</button> --}}
                  </div>
                  <div class="table-responsive-lg">
                      @if(sizeof($data) > 0)
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Stt</th>
                          <th scope="col">Tên</th>
                          <th scope="col">Khách hàng</th>
                          <th scope="col">Phòng</th>
                          <th scope="col">Thời gian</th>
                          <th scope="col">Tiền cọc</th>
                          {{-- <th scope="col"></th> --}}
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($data as $k => $v)
                          <tr class="text-center">
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->customer->name }}</td>
                            <td>{{ $v->room->name }}</td>
                            <td>{{date('d/m/Y',$v->start).' - '.date('d/m/Y',$v->end)}}</td>
                            <td>{{ number_format($v->deposits) }}</td>
                            <th scope="row">

                              <a class="btn btn-info btn-sm" href="{{ route('my.contract.getCreate', $v->id) }}" title="Sửa hợp đồng">
                                <i class="fas fa-pencil-alt"></i></a>
                              <a class="btn btn-warning btn-sm" href="{{ route('my.bill.getCreate', $v->id) }}" title="Tạo hóa đơn">
                                <i class="fas fa-file-invoice-dollar"></i></a>
                              <a class="btn btn-primary btn-sm" href="{{ route('my.contract.pdf', $v->id) }}" title="Xuất PDF">
                                <i class="fas fa-file-pdf"></i></a>
                            <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{ route('my.contract.remove', $v->id) }}">
                                    
                                      <i class="fas fa-trash-alt"></i>
                                    
                                </a>
                            </th>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $data->links() }}
                    @else
                    <h4>Chưa có hợp đồng</h4>
                    @endif
                  </div>
                </div>
                
                <div id="mdl1"></div>
                <div id="mdl3"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
    <!-- ==============Start Modal House=============== -->
    <div class="modal fade" id="modalHouse" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="md-app-name"></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle mr-2"></i>Đóng</button>
              <button type="button" class="btn btn-primary"><i class="fas fa-check mr-2"></i>Đồng ý</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Start Modal House -->
    
      <!-- ==========Set Modal Form App House======== -->
      <div id="mdl2" class="container">
        <div class="container">
          <div class="col">
            Bạn có muốn sao lưu phòng trọ này không ?
          </div>
        </div>
      </div>
    
      <div id="mdl4" class="container">
        <div class="container">
          <div class="col" style="color: red;">
            Bạn có muốn xóa nhà trọ này không ?
          </div>
        </div>
      </div>
      <!-- ==========End Set Modal========== -->
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
