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
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex gap-3 flex-column">
                                                    <a href="#!" class="btn btn-md btn-outline-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-google"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                                        </svg>
                                                        <span class="ms-2 fs-6">Đăng nhập với google</span>
                                                    </a>
                                                </div>
                                                <p class="text-center mt-4 mb-5">Hoặc đăng nhập với</p>
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
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="remember_me" id="remember_me">
                                                        <label class="form-check-label text-secondary" for="remember_me">
                                                            Ghi nhớ
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-md" type="submit">Đăng
                                                            nhập</button>
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
                                                    <a href="#!" class="link-secondary text-decoration-none">Quên Mật
                                                        khẩu</a>
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
