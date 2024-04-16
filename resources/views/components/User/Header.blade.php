<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand text-danger fw-bold" href="{{ route('index') }}">TRANTSLATEGROUP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto nav-underline">
                <li class="nav-item">
                    <a class="nav-link text-black display-4 active" href="{{ route('index') }}" aria-current="page"
                        href="#">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black display-4" href="#">Về chúng tôi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-black display-4 dropdown-toggle  {{ $title == 'Service' ? 'active' : '' }}"
                        href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dịch vụ
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @if (isset($prop))
                            @foreach ($prop as $item)
                                <li><a class="dropdown-item"
                                        href="{{ route('service', ['data' => $item->service_code]) }}">{{ $item->service_name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black display-4" href="#">Liên hệ</a>
                </li>
            </ul>
            <div class="ms-auto d-flex align-items-center">
                <form class="d-flex me-2">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <a href="{{ route('cart') }}" class="btn btn-outline-dark me-2">
                    <i class="bi bi-cart4"></i> <span class="badge text-bg-danger">
                        @if (isset($order))
                            {{ $order }}
                        @else
                            0
                        @endif
                    </span>
                </a>
                <a href="{{ route('priceRequestUser') }}" class="btn btn-outline-dark me-2">
                    <i class="bi bi-tags"></i> <span class="badge text-bg-danger">
                        @if (isset($priceRequest))
                            {{ $priceRequest }}
                        @else
                            0
                        @endif
                    </span>
                </a>
                @if (Auth::check() && Auth::user()->position == 3)
                    <a class="btn btn-outline-dark" href="{{ route('logout') }}">{{ Auth::user()->name }}</a>
                @else
                    <a class="btn btn-outline-dark" href="{{ route('login') }}">Đăng nhập</a>
                @endif
            </div>
        </div>
    </div>
</nav>
