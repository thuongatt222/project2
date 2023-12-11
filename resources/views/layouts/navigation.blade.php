<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
{{--            <i class="fas fa-laugh-wink"></i>--}}
            <img src="http://127.0.0.1:8000/images/img.png" alt="" class="img-profile rounded-circle" style="width: 50px">
        </div>
        <div class="sidebar-brand-text mx-3">BKACAD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->routeIs('home')) active @endif">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Trang chủ') }}</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item @if(request()->routeIs('school_year')) active @endif">
        <a class="nav-link" href="{{ route('school_year') }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span>{{ __('Niên khóa') }}</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->routeIs('major')) active @endif">
        <a class="nav-link" href="{{ route('major') }}">
            <i class="fa-solid fa-list"></i>
            <span>{{ __('Chuyên ngành') }}</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('fee')) active @endif">
        <a class="nav-link" href="{{ route('fee') }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>{{ __('Đợt đóng học phí') }}</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('tuition')) active @endif">
        <a class="nav-link" href="{{ route('tuition') }}">
            <i class="fa-solid fa-money-check-dollar"></i>
            <span>{{ __('Quản lý học phí') }}</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('student')) active @endif">
        <a class="nav-link" href="{{ route('student') }}">
            <i class="fa-solid fa-users"></i>
            <span>{{ __('Danh sách sinh viên') }}</span></a>
    </li>

    <li class="nav-item @if(request()->routeIs('user')) active @endif">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fa-solid fa-user-shield"></i>
            <span>{{ __('Quản lý tài khoản') }}</span></a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
