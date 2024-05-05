@extends('Layouts.core.MasterLayout')

@section('content')
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            @if (session('message'))
                <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 1050;">
                    <div id="myToast"
                        class="toast align-items-center {{ session('status') == true ? 'text-bg-success' : 'text-bg-danger' }}"
                        role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('message') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0 w-100">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                    src="{{ asset('assets/images/bg_login.jpg') }}" alt="Welcome back you've been missed!">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="{{ route('index') }}"
                                                            class="text-decoration-none text-dark">
                                                            <h3 class="text-center">Đăng nhập</h3>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('checklogin') }}">
                                            @csrf
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="name@example.com" required>
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" value="{{ old('password') }}"
                                                            placeholder="Password" required>
                                                        <label for="password" class="form-label">Mật khẩu</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-success btn-md" type="submit">Đăng
                                                            nhập</button>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <a href="{{ route('index') }}" class="btn btn-secondary btn-md"
                                                            type="submit">Quay lại</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                                    <a href="{{ route('register') }}"
                                                        class="link-secondary text-decoration-none">Tạo tài khoản</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
