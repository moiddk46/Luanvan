@extends('Layouts.Admin.MasterLayout')

@section('content')
    <div class="border border-light px-5">
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
        <div class="row">
            <form action="{{ route('addUser') }}" method="post">
                @csrf
                <table class="table align-middle mb-0 bg-white mt-5 table-striped">
                    <thead>
                        <tr>
                            <th class="w-25">Tiêu đề</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Tên người dùng</th>
                            <td><input type="text" class="form-control" name="name">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="text" class="form-control" name="email">
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Quyền hạn</th>
                            <td class="row">
                                <div class="col-6">
                                    <select id="position" class="form-select form-select-md"
                                        aria-label="Small select example" name="position">
                                        @for ($i = 3; $i >= 1; $i--)
                                            <option value="{{ $i }}">
                                                @if ($i == '1')
                                                    Quản trị viên
                                                @elseif ($i == '2')
                                                    Nhân viên
                                                @else
                                                    Khách hàng
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Mật khẩu</th>
                            <td><input type="password" class="form-control" name="password">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Nhập lại mật khẩu</th>
                            <td><input type="password" class="form-control" name="confirmpassword">
                                @error('confirmpassword')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('allUser') }}" class="btn btn-secondary me-2">Quay
                        lại</a>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
