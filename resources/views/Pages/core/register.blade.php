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
                                                        <input type="password" class="form-control" id="confirmpassword"
                                                            name="confirmpassword" value="{{ old('confirmpassword') }}"
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
                                                        <button class="btn btn-success btn-md" type="submit">Đăng
                                                            ký</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
