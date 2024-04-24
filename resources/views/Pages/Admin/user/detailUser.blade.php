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
            @if (isset($data))
                <form action="{{ route('updateUser') }}" method="post">
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
                                <th>Mã người dùng</th>
                                <td>{{ $data->id }}</td>
                                <input type="hidden" value="{{ $data->id }}" name="id">
                            </tr>
                            <tr>
                                <th>Tên người dùng</th>
                                <td><input type="text" class="form-control" value="{{ $data->name }}" name="username">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><input type="text" class="form-control" value="{{ $data->email }}" name="email">
                                </td>
                            </tr>
                            <tr>
                                <th>Quyền hạn</th>
                                <td class="row">
                                    <div class="col-6">
                                        <select id="position" class="form-select form-select-md"
                                            aria-label="Small select example" name="position"
                                            {{ Auth::user()->id == $data->id ? 'disabled' : '' }}>
                                            <option value="{{ $data->position }}">
                                                @if ($data->position == '1')
                                                    Quản trị viên
                                                @elseif ($data->position == '2')
                                                    Nhân viên
                                                @else
                                                    Khách hàng
                                                @endif
                                            </option>
                                            @for ($i = 1; $i <= 3; $i++)
                                                @if ($i == $data->position)
                                                    {
                                                    continue;
                                                    }
                                                @else
                                                    <option value="{{ $i }}">
                                                        @if ($i == '1')
                                                            Quản trị viên
                                                        @elseif ($i == '2')
                                                            Nhân viên
                                                        @else
                                                            Khách hàng
                                                        @endif
                                                    </option>
                                                @endif
                                            @endfor
                                        </select>
                                        <div class="form-text text-danger" id="message_disable"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Ngày cập nhật</th>
                                <td>{{ $data->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('allUser') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
