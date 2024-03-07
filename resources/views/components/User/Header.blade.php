<nav class="navbar navbar-dropdown navbar-expand-lg navCustom ">
    <div class="container contentnav fs-5">
        <div class="navbar-brand">
            <span class="navbar-logo">
                <a class="text-decoration-none text-danger fw-bold fs-3" href="">COMPANYCODE</a>
            </span>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"
            data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse opacityScroll" id="navbarSupportedContent">
            <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0 nav-dropdown nav-right" data-app-modern-menu="true">
                <li class="nav-item">
                    <a class="nav-link link text-black display-4 {{ $title == 'Home' ? 'active' : '' }}" href="{{ route('index') }}">Trang Chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black display-4 dropdown-toggle {{ $title == 'Service' ? 'active' : '' }}" href="" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dịch vụ
                    </a>
                    <ul class="dropdown-menu bg-light">
                        @if (isset($prop))
                            @foreach ($prop as $item)
                                <li><a class="dropdown-item link"
                                        href="{{ route('service') }}">{{ $item->service_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black display-4 dropdown-toggle" href="" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Giới thiệu
                    </a>
                    <ul class="dropdown-menu bg-light">
                        <li><a class="dropdown-item link" href="#">Về chúng tôi</a></li>
                        <li><a class="dropdown-item link" href="#">Tuyển dụng</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="">Liên hệ</a>
                </li>
            </ul>
            <div class="d-flex align-content-end">
                <a class="btn btn-dark btn-lg" href="">Đăng nhập</a>
            </div>

        </div>
    </div>
</nav>
