<nav class=" d-md-block bg-light sidebar collapse position-fixed h-100 z-1" style="width: 20%" id="sidebar">
    <div class="sidebar-sticky mt-5">
        <ul class="nav flex-column nav-underline w-50 m-auto">
            <li class="nav-item mt-3">
                <a class="nav-link text-black {{ Request::is('admin/home*') ? 'active' : '' }}" href="{{ route('indexAdmin') }}" id="thongke"><i
                        class="bi bi-bar-chart-line-fill me-2"></i>Thống kê</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black {{ Request::is('admin/service*') ? 'active' : '' }}" href="{{ route('allService') }}"><i class="bi bi-database me-2"></i>Dịch
                    vụ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black {{ Request::is('admin/user*') ? 'active' : '' }}" href="{{ route('allUser') }}"><i
                        class="bi bi-person-workspace me-2"></i>Người dùng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black {{ Request::is('admin/rating*') ? 'active' : '' }}" href="{{ route('listRating') }}"> <i
                        class="bi bi-person-video me-2"></i>Đánh giá</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black {{ Request::is('admin/order*') ? 'active' : '' }}" href="{{ route('orderAdmin') }}"><i class="bi bi-card-list me-2"></i>Đơn
                    hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black {{ Request::is('admin/priceRequest*') ? 'active' : '' }}" href="{{ route('priceRequestAdmin') }}"><i
                        class="bi bi-tags me-2"></i>Báo giá</a>
            </li>

        </ul>
    </div>
</nav>
