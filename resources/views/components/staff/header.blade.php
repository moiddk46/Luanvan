<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand text-danger fw-bold" href="{{ route('indexStaff') }}">TRANTSLATEGROUP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto nav-underline">
                <li class="nav-item">
                    <a class="nav-link text-black display-4 active" href="{{ route('indexStaff') }}" aria-current="page">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black display-4" href="{{ route('task') }}">Nhiệm vụ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black display-4" href="#">Đánh giá dịch vụ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black display-4" href="{{ route('calenderStaff') }}">Lịch làm việc</a>
                </li>
            </ul>
            <div class="ms-auto d-flex align-items-center">
                <form class="d-flex me-2">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                </form>
                @if (Auth::check() && Auth::user()->position == 2)
                    <a class="btn btn-outline-dark" href="{{ route('logout') }}">{{ Auth::user()->name }}</a>
                @else
                    <a class="btn btn-outline-dark" href="{{ route('login') }}">Đăng nhập</a>
                @endif
            </div>
        </div>
    </div>
</nav>
