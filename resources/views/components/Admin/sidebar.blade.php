<nav class="col-md-2 d-md-block bg-light sidebar collapse" id="sidebar">
    <div class="sidebar-sticky mt-5">
        <ul class="nav flex-column nav-underline w-50 m-auto">
            <li class="nav-item mt-3">
                <a class="nav-link text-black" href="{{ route('indexAdmin') }}"><i
                        class="bi bi-bar-chart-line-fill me-2"></i>Thống kê</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{ route('allService') }}"><i class="bi bi-database me-2"></i>Dịch
                    vụ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{ route('allStaff') }}"><i
                        class="bi bi-person-workspace me-2"></i>Nhân viên</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{ route('allCustomer') }}"> <i
                        class="bi bi-person-video me-2"></i>Khách hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{ route('orderAdmin') }}"><i class="bi bi-card-list me-2"></i>Đơn
                    hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="{{ route('priceRequestAdmin') }}"><i
                        class="bi bi-tags me-2"></i>Báo giá</a>
            </li>

        </ul>
    </div>
</nav>
