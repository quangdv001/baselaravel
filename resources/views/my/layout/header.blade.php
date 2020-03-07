<header class="header_app">
    <div class="main-menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('public/assets/site/themes/assets/images/logo.png') }}"  class="d-inline-block align-top" alt="">
          
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <span class="mr-auto"></span>
          <ul class="navbar-nav">
            {{-- <li class="nav-item active">
              <a class="nav-link" href="#"><i class="fas fa-user mr-2"></i>Quản lý người dùng *</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog mr-2"></i>Hệ thống
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#"><i class="fas fa-bell mr-2"></i>Cài đặt thông báo</a>
                <a class="dropdown-item" href="#"><i class="fas fa-play mr-2"></i>Đồng bộ hóa thông báo</a>
              </div>
            </li> --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user mr-2"></i>{{ auth()->user()->email }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                {{-- <a class="dropdown-item" href="#"><i class="fas fa-address-card mr-2"></i>Thông tin cá nhân</a> --}}
                <a class="dropdown-item" href="{{ route('site.auth.logout') }}"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="main-menu-item">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="justify-content-center"></div>
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item active mr-4">
              <a
                class="nav-link @yield('menu1', '')"
                id="pills-home-tab"
                {{-- data-toggle="pill" --}}
                href="{{ route('my.motel.getList') }}"
                {{-- role="tab" --}}
                aria-controls="nha-tro"
                aria-selected="true"><i class="fas fa-home mr-2"></i><span>Nhà trọ</span></a>
            </li>
            <li class="nav-item mr-4">
              <a
                class="nav-link @yield('menu2', '')"
                id="pills-room-tab"
                {{-- data-toggle="pill" --}}
                href="{{ route('my.room.getList') }}"
                {{-- role="tab" --}}
                aria-controls="phong-tro"
                aria-selected="false"><i class="fas fa-address-book mr-2"></i><span>Phòng trọ</span></a>
            </li>
            <li class="nav-item mr-4">
              <a class="nav-link @yield('menu3', '')"
              id="pills-dv-tab"
              {{-- data-toggle="pill" --}}
              href="{{ route('my.service.getList') }}"
              {{-- role="tab" --}}
              aria-controls="dich-vu"
              aria-selected="false"><i class="fas fa-subway mr-2"></i><span>Dịch vụ</span></a>
            </li>
            <li class="nav-item mr-4">
              <a  class="nav-link @yield('menu4', '')"
              id="pills-hd-tab"
              {{-- data-toggle="pill" --}}
              href="#hop-dong"
              {{-- role="tab" --}}
              aria-controls="hop-dong"
              aria-selected="false"><i class="fas fa-file-signature mr-2"></i><span>Hợp đồng</span></a>
            </li>
            <li class="nav-item mr-4">
              <a class="nav-link @yield('menu5', '')"
              id="pills-user-tab"
              {{-- data-toggle="pill" --}}
              href="#user"
              {{-- role="tab" --}}
              aria-controls="user"
              aria-selected="false"><i class="fas fa-users mr-2"></i><span>User</span></a>
            </li>
            <li class="nav-item mr-4">
              <a class="nav-link @yield('menu6', '')"
              id="pills-user-tab"
              {{-- data-toggle="pill" --}}
              href="{{ route('my.customer.getList') }}"
              {{-- role="tab" --}}
              aria-controls="user"
              aria-selected="false"><i class="fas fa-users mr-2"></i><span>Khách hàng</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>