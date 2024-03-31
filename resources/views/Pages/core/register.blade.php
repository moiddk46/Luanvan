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
                        <div class="row g-0">
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="{{ route('index') }}"
                                                            class="text-decoration-none text-dark">
                                                            <h3 class="text-center">Đăng ký</h3>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="post" action="{{ route('registerCreate') }}">
                                            @csrf
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="name" class="form-control" id="name"
                                                            name="name" value="{{ old('name') }}"
                                                            placeholder="Tên người dùng" required>
                                                        <label for="name" class="form-label">Tên người dùng</label>
                                                        @error('name')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="name@example.com" required>
                                                        <label for="email" class="form-label">Email</label>
                                                        @error('email')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" value="{{ old('password') }}"
                                                            placeholder="Mật khẩu" required>
                                                        <label for="password" class="form-label">Mật khẩu</label>
                                                        @error('password')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control"
                                                            id="confirmpassword" name="confirmpassword"
                                                            value="{{ old('confirmpassword') }}"
                                                            placeholder="Nhập lại mật khẩu" required>
                                                        <label for="confirmpassword" class="form-label">Nhập lại mật
                                                            khẩu</label>
                                                        @error('confirmpassword')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" name="position" value="2">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-md" type="submit">Đăng
                                                            ký</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-center mt-3 mb-3">Hoặc</p>
                                                <div class="d-flex gap-3 flex-column">
                                                    <a href="#!" class="btn btn-md btn-outline-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-google"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                                        </svg>
                                                        <span class="ms-2 fs-6">Đăng ký với google</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-3">
                                                    <a href="{{ route('login') }}"
                                                        class="link-secondary text-decoration-none">Đã có tài khoản</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                    src="{{ asset('assets/images/bg_login.jpg') }}" alt="Welcome back you've been missed!">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
