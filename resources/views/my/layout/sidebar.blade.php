<div class="card border-light mt-5">
  <div class="card-header">Thông tin tài khoản</div>
  <div class="card-body">
    <div class="avatar-holder text-center">
      <i class="far fa-user-circle fa-5x"></i>
    </div>
    <div class="title-avatar">{{ auth()->user()->name }}</div>
    <div class="title-name-user">{{ auth()->user()->email }}</div>
    <ul class="list-group list-group-flush mt-4">
      <li class="list-group-item"><i class="fas fa-book-open mr-2"></i><b>Thông tin</b></li>
      <li class="list-group-item">Tham gia hệ thống: {{ auth()->user()->created_at->format('d/m/Y') }}</li>
      <li class="list-group-item">Hạn sử dụng: {{ date('d/m/Y', auth()->user()->expired_at) }}</li>
    </ul>

    {{-- <ul class="list-group list-group-flush mt-1">
      <li class="list-group-item"><i class="fas fa-file-contract mr-2"></i><b>Nhà thuê</b></li>
      <div class="mt-3">
        <p class="">Phòng trọ sử dụng</p>
        <div class="progress">
          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">70%</div>
        </div>
      </div>
      <div class="mt-3">
        <p class="">Hợp đồng thanh toán</p>
        <div class="progress">
          <div class="progress-bar bg-primary" role="progressbar" style="width: 18%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">18%</div>
        </div>
      </div>
      <div class="mt-3">
        <p class="">Thông báo đã gửi</p>
        <div class="progress mt-3">
          <div class="progress-bar bg-primary" role="progressbar" style="width: 12%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">12%</div>
        </div>
      </div>
      <div class="mt-3">
        <p class="">Trạng thái active</p>
        <div class="progress mt-3">
          <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
        </div>
      </div>
    </ul> --}}
  </div>
</div>